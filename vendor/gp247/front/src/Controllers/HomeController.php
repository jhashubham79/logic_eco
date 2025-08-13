<?php
namespace GP247\Front\Controllers;

use GP247\Front\Controllers\RootFrontController;
use GP247\Front\Models\FrontPage;
use GP247\Front\Models\FrontBanner;
use App\Services\OpenAIService;
use GP247\Shop\Admin\Models\AdminProduct;
use Illuminate\Support\Facades\DB;
class HomeController extends RootFrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $contentHome = (new FrontPage)->getDetail('home', $type = 'alias', $checkActive = 0);
        $view = $this->GP247TemplatePath . '.screen.home';
        gp247_check_view($view);
        return view(
            $view,
            array(
                'title'       => gp247_store_info('title'),
                'keyword'     => gp247_store_info('keyword'),
                'description' => gp247_store_info('description'),
                'storeId'     => config('app.storeId'),
                'contentHome' => $contentHome,
                'layout_page' => 'front_home',
            )
        );
    }

        /**
     * Process front form page detail
     *
     * @param [type] ...$params
     * @return void
     */
    public function pageDetailProcessFront(...$params)
    {
        if (GP247_SEO_LANG) {
            $lang = $params[0] ?? '';
            $alias = $params[1] ?? '';
            gp247_lang_switch($lang);
        } else {
            $alias = $params[0] ?? '';
        }
        return $this->_pageDetail($alias);
    }

    
    /**
     * Render page
     * @param  [string] $alias
     */
    private function _pageDetail($alias)
    {
        $page = (new FrontPage)->getDetail($alias, $type = 'alias');
        if ($page) {
            $view = $this->GP247TemplatePath . '.screen.page_detail';
            gp247_check_view($view);
            return view(
                $view,
                array(
                    'title'       => $page->title,
                    'description' => $page->description,
                    'keyword'     => $page->keyword,
                    'page'        => $page,
                    'og_image'    => gp247_file($page->getImage()),
                    'layout_page' => 'front_page_detail',
                    'breadcrumbs' => [
                        ['url'    => '', 'title' => $page->title],
                    ],
                )
            );
        } else {
            return $this->pageNotFound();
        }
    }

    
    /**
     * Process front search page
     *
     * @param [type] ...$params
     * @return void
     */
    public function searchProcessFront(...$params)
    {
        if (GP247_SEO_LANG) {
            $lang = $params[0] ?? '';
            gp247_lang_switch($lang);
        }
        return $this->_search();
    }

    /**
     * search product
     * @return [view]
     */
    // private function _search()
    // {
    //     $keyword = request('keyword');
    //     $keyword = gp247_clean(data:$keyword, hight:true);

    //     //$searchMode = config('gp247-config.front.GP247_SEARCH_MODE');
    //         $searchMode = 'PRODUCT';   

    //     if (strtoupper($searchMode) === 'PRODUCT' && class_exists('\GP247\Shop\Models\ShopProduct')) {
    //         if ($keyword) {
    //             $itemsList = (new \GP247\Shop\Models\ShopProduct)
    //             ->setLimit(gp247_config('product_list'))
    //             ->setKeyword($keyword)
    //             ->setPaginate()
    //             ->getData();
    //         } else {
    //             $itemsList = collect([]);
    //         }
    //         $view = $this->GP247TemplatePath . '.screen.shop_search';
    //         $layout_page = 'shop_search';
    //         $subPath = 'screen.shop_search';
    //         if (!view()->exists($view)) {
    //             if (!view()->exists('gp247-shop-front::'.$subPath)) {
    //                 gp247_report('View not found '.$view);
    //                 echo  gp247_language_render('front.view_not_exist', ['view' => $view]);
    //                 exit();
    //             }
    //             $view = 'gp247-shop-front::'.$subPath;
    //         }
    //     } else {
    //         if ((strtoupper($searchMode) === 'NEWS' && gp247_config_global('News') && class_exists('\App\GP247\Plugins\News\Models\NewsContent'))) {
    //             if ($keyword) {
    //                 $itemsList = (new \App\GP247\Plugins\News\Models\NewsContent)
    //                 ->setLimit(gp247_config('page_list'))
    //                 ->setKeyword($keyword)
    //                 ->setPaginate()
    //                 ->getData();
    //             } else {
    //                 $itemsList = collect([]);
    //             }
    //         } else {
    //             if ($keyword) {
    //                 $itemsList = (new FrontPage)
    //                 ->setLimit(gp247_config('page_list'))
    //                 ->setKeyword($keyword)
    //                 ->setPaginate()
    //                 ->getData();
    //             } else {
    //                 $itemsList = collect([]);
    //             }
    //         }
    //         $view = $this->GP247TemplatePath . '.screen.front_search';
    //         $layout_page = 'front_search';
    //     }

    //     gp247_check_view($view);

    //     return view(
    //         $view,
    //         array(
    //             'title'       => gp247_language_render('action.search') . ($keyword ? ': ' . $keyword : ''),
    //             'itemsList'   => $itemsList,
    //             'layout_page' => $layout_page,
    //             'breadcrumbs' => [
    //                 ['url'    => '', 'title' => gp247_language_render('action.search')],
    //             ],
    //         )
    //     );
    // }

private function _search()
{
    $keyword = request('keyword');
    $keyword = gp247_clean(data: $keyword, hight: true);

    $stopWords = [
        'fix', 'manage', 'need', 'want', 'do', 'get', 'make', 'create', 'build',
        'done', 'can', 'please', 'project', 'solution', 'help', 'how', 'to', 'for',
        'with', 'like', 'issue', 'support', 'work', 'me', 'my', 'a', 'the', 'of',
    ];

    // 🔗 Get structured query from OpenAI
    $openAIService = new OpenAIService();
    $structuredQuery = $openAIService->processQuery($keyword);

    // 🔍 Base filters
    $filters = [
        'keywords'   => $keyword,
        'category'   => null,
        'min_price'  => null,
        'max_price'  => null,
    ];

    // ✅ If OpenAI returned useful structure
    if (is_array($structuredQuery)) {
        if (isset($structuredQuery['keywords'])) {
            $words = is_array($structuredQuery['keywords'])
                ? $structuredQuery['keywords']
                : explode(' ', strtolower($structuredQuery['keywords']));

            // Remove stopwords
            $filtered = array_filter($words, function ($word) use ($stopWords) {
                return !in_array(strtolower(trim($word)), $stopWords) && strlen(trim($word)) > 2;
            });

            $structuredQuery['keywords'] = implode(' ', $filtered);
        }

        $filters = array_merge($filters, $structuredQuery);
    }

    $searchMode = 'PRODUCT';

    if (strtoupper($searchMode) === 'PRODUCT') {
    $words = !empty($filters['keywords']) ? explode(' ', $filters['keywords']) : [];

    $baseQuery = DB::table('gp247_shop_product as p')
        ->join('gp247_shop_product_description as pd', 'p.id', '=', 'pd.product_id')
        ->select('p.*', 'pd.name', 'pd.description')
        ->selectRaw('(
            ' . collect($words)->map(function ($word) {
                $word = trim($word);
                $like = "%{$word}%";
                return "(CASE WHEN pd.name LIKE '{$like}' THEN 3 WHEN pd.description LIKE '{$like}' THEN 1 ELSE 0 END)";
            })->implode(' + ') . '
        ) as relevance_score');

    // 🟩 Perfect Matches (score >= threshold and price filters)
    $perfectMatches = (clone $baseQuery)
        ->where(function ($query) use ($words) {
            foreach ($words as $word) {
                $like = '%' . trim($word) . '%';
                $query->orWhere('pd.name', 'like', $like)
                      ->orWhere('pd.description', 'like', $like);
            }
        })
        ->when($filters['min_price'], fn($q) => $q->where('p.price', '>=', $filters['min_price']))
        ->when($filters['max_price'], fn($q) => $q->where('p.price', '<=', $filters['max_price']))
        ->having('relevance_score', '>=', 4)
        ->orderByDesc('relevance_score')
        ->limit(20)
        ->get();

    // 🟨 Price Mismatch
    $priceMismatchMatches = (clone $baseQuery)
        ->where(function ($query) use ($words) {
            foreach ($words as $word) {
                $like = '%' . trim($word) . '%';
                $query->orWhere('pd.name', 'like', $like)
                      ->orWhere('pd.description', 'like', $like);
            }
        })
        ->where(function ($query) use ($filters) {
            if (!empty($filters['min_price'])) {
                $query->where('p.price', '<', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $query->where('p.price', '>', $filters['max_price']);
            }
        })
        ->having('relevance_score', '>=', 4)
        ->orderByDesc('relevance_score')
        ->limit(20)
        ->get();

    // 🟦 Similar Suggestions (low score 1-3)
    $similarMatches = (clone $baseQuery)
        ->where(function ($query) use ($words) {
            foreach ($words as $word) {
                $like = '%' . trim($word) . '%';
                $query->orWhere('pd.name', 'like', $like)
                      ->orWhere('pd.description', 'like', $like);
            }
        })
        ->havingBetween('relevance_score', [1, 3])
        ->orderByDesc('relevance_score')
        ->limit(20)
        ->get();
}


$view = $this->GP247TemplatePath . '.screen.shop_search';
        $layout_page = 'shop_search';
        $subPath = 'screen.shop_search';

        if (!view()->exists($view)) {
            if (!view()->exists('gp247-shop-front::' . $subPath)) {
                gp247_report('View not found ' . $view);
                echo gp247_language_render('front.view_not_exist', ['view' => $view]);
                exit();
            }
            $view = 'gp247-shop-front::' . $subPath;
        }
 //  dd($itemsList);
    gp247_check_view($view);

// Ensure collections
$perfectMatches = $perfectMatches ?? collect();
$priceMismatchMatches = $priceMismatchMatches ?? collect();
$similarMatches = $similarMatches ?? collect();

// Collect all shown product IDs
$shownIds = $perfectMatches->pluck('id')->toArray();

// Remove duplicates from priceMismatchMatches
$priceMismatchMatches = $priceMismatchMatches->reject(function ($item) use ($shownIds) {
    return in_array($item->id, $shownIds);
});
$shownIds = array_merge($shownIds, $priceMismatchMatches->pluck('id')->toArray());

// Remove duplicates from similarMatches
$similarMatches = $similarMatches->reject(function ($item) use ($shownIds) {
    return in_array($item->id, $shownIds);
});



   return view($view, [
    'title'       => gp247_language_render('action.search') . ($keyword ? ': ' . $keyword : ''),
    'perfectMatches' => $perfectMatches,
    'priceMismatchMatches' => $priceMismatchMatches,
    'similarMatches' => $similarMatches,
    'layout_page' => $layout_page,
    'breadcrumbs' => [
        ['url' => '', 'title' => gp247_language_render('action.search')],
    ],
]);

}





    /**
     * Process click banner
     *
     * @param   [int]  $id
     *
     */
    public function clickBanner($id = 0)
    {
        $banner = FrontBanner::find($id);
        if ($banner) {
            $banner->click +=1;
            $banner->save();
            return redirect(url($banner->url??'/'));
        }
        return redirect(url('/'));
    }
}
