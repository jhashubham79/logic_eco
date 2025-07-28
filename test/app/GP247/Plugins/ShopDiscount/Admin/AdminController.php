<?php
#App\GP247\Plugins\ShopDiscount\Admin\AdminController.php

namespace App\GP247\Plugins\ShopDiscount\Admin;

use GP247\Core\Controllers\RootAdminController;
use App\GP247\Plugins\ShopDiscount\AppConfig;
use App\GP247\Plugins\ShopDiscount\Models\ShopDiscount;
use App\GP247\Plugins\ShopDiscount\Models\ShopDiscountStore;
use GP247\Core\Models\AdminStore;
use Illuminate\Support\Facades\Validator;
class AdminController extends RootAdminController
{
    public $plugin;

    public function __construct()
    {
        parent::__construct();
        $this->plugin = new AppConfig;
    }
    public function index()
    {
        $data = [
            'title' => gp247_language_render($this->plugin->appPath.'::lang.admin.list'),
            'subTitle' => '',
            'icon' => 'fa fa-indent',
            'urlDeleteItem' => gp247_route_admin('admin_discount.delete'),
            'removeList' => 1, // 1 - Enable function delete list item
            'buttonRefresh' => 1, // 1 - Enable button refresh
        ];
        
        $listTh = [
            'code' => gp247_language_render($this->plugin->appPath.'::lang.code'),
            'reward' => gp247_language_render($this->plugin->appPath.'::lang.reward'),
            'type' => gp247_language_render($this->plugin->appPath.'::lang.type'),
            'data' => gp247_language_render($this->plugin->appPath.'::lang.data'),
            'used' => gp247_language_render($this->plugin->appPath.'::lang.used'),
            'status' => gp247_language_render($this->plugin->appPath.'::lang.status'),
        ];

        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            if (session('adminStoreId') == GP247_STORE_ID_ROOT) {
                // Only show store info if store is root
                $listTh['shop_store'] = gp247_language_render('front.store_list');
            }
        }
        $listTh['login'] = gp247_language_render($this->plugin->appPath.'::lang.login');
        $listTh['expires_at'] = gp247_language_render($this->plugin->appPath.'::lang.expires_at');
        $listTh['action'] = gp247_language_render($this->plugin->appPath.'::lang.admin.action');


        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => gp247_language_render($this->plugin->appPath.'::lang.admin.sort_order.id_desc'),
            'id__asc' => gp247_language_render($this->plugin->appPath.'::lang.admin.sort_order.id_asc'),
            'code__desc' => gp247_language_render($this->plugin->appPath.'::lang.admin.sort_order.code_desc'),
            'code__asc' => gp247_language_render($this->plugin->appPath.'::lang.admin.sort_order.code_asc'),
        ];
        $dataSearch = [
            'keyword'    => $keyword,
            'sort_order' => $sort_order,
            'arrSort'    => $arrSort,
        ];

        $dataTmp = (new ShopDiscount)->getDiscountListAdmin($dataSearch);
        $arrDiscountId = $dataTmp->pluck('id')->toArray();
        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            if (session('adminStoreId') == GP247_STORE_ID_ROOT) {
                // Only show store info if store is root
                $tableStore = (new AdminStore)->getTable();
                $tableDiscountStore = (new ShopDiscountStore)->getTable();
                $dataStores =  ShopDiscountStore::select($tableStore.'.code', $tableStore.'.id', 'discount_id')
                    ->join($tableStore, $tableStore.'.id', $tableDiscountStore.'.store_id')
                    ->whereIn('discount_id', $arrDiscountId)
                    ->get()
                    ->groupBy('discount_id');
            }
        }

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $arrAction = [];
            $arrAction[] = '<a href="' . gp247_route_admin('admin_discount.edit', ['id' => $row['id'] ? $row['id'] : 'not-found-id']) . '" class="dropdown-item"><i class="fa fa-edit"></i> '.gp247_language_render('action.edit').'</a>';
            $arrAction[] = '<a href="#" onclick="deleteItem(\'' . $row['id'] . '\');"  title="' . gp247_language_render('action.delete') . '" class="dropdown-item"><i class="fas fa-trash-alt"></i> '.gp247_language_render('action.remove').'</a>';
            $action = $this->procesListAction($arrAction);

            $dataMap = [
                'code' => $row['code'],
                'reward' => $row['reward'],
                'type' => ($row['type'] == 'point') ? 'Point' : '%',
                'data' => $row['data'],
                'used' => $row['used'].'/'.$row['limit'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
            ];

            if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
                $dataMap['shop_store'] = '';
                if (session('adminStoreId') == GP247_STORE_ID_ROOT) {
                    // Only show store info if store is root
                    if (!empty($dataStores[$row['id']])) {
                       $storeTmp = $dataStores[$row['id']]->pluck('code', 'id')->toArray();
                       $storeTmp = array_map(function($code) {
                            return '<a target=_new href="'.gp247_store_get_domain_from_code($code).'">'.$code.'</a>';
                        }, $storeTmp);
                       $dataMap['shop_store'] = '<i class="nav-icon fab fa-shopify"></i> '.implode('<br><i class="nav-icon fab fa-shopify"></i> ', $storeTmp);
                    }
                }
            }

            $dataMap['login'] = $row['login'];
            $dataMap['expires_at'] = $row['expires_at'];
            $dataMap['action'] = $action;
            $dataTr[$row['id']] = $dataMap;
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('gp247-core::component.pagination');
        $data['resultItems'] = gp247_language_render($this->plugin->appPath.'::lang.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'total' =>  $dataTmp->total()]);

        //menuRight
        $data['menuRight'][] = '<a href="' . gp247_route_admin('admin_discount.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus" title="' . gp247_language_render($this->plugin->appPath.'::lang.admin.add_new') . '"></i>
                           </a>';
        //=menuRight

        //menuSort
        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }
        //=menuSort

        //menuSearch
        $data['topMenuRight'][] = '
              <form action="' . gp247_route_admin('admin_discount.index') . '" id="button_search">
                <div class="input-group input-group" style="width: 350px;">
                <select class="form-control rounded-0 select2" name="sort_order" id="sort_order">
                '.$optionSort.'
                </select> &nbsp;
                    <input type="text" name="keyword" class="form-control float-right" placeholder="' . gp247_language_render($this->plugin->appPath.'::lang.admin.search_place') . '" value="' . $keyword . '">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                </form>';
        //=menuSearch

        return view('gp247-core::screen.list')
            ->with($data);
    }

/**
 * Form create new
 * @return [type] [description]
 */
    public function create()
    {
        $data = [
            'title' => gp247_language_render($this->plugin->appPath.'::lang.admin.add_new_title'),
            'subTitle' => '',
            'title_description' => gp247_language_render($this->plugin->appPath.'::lang.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'discount' => [],
            'url_action' => gp247_route_admin('admin_discount.create'),
            'appPath' => $this->plugin->appPath,
        ];
        return view($this->plugin->appPath.'::Admin')
            ->with($data);
    }

/**
 * Post create new 
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'code'   => 'required|regex:/(^([0-9A-Za-z\-\._]+)$)/|discount_unique|string|max:50',
            'limit'  => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
            'type'   => 'required',
        ], [
            'code.regex' => gp247_language_render($this->plugin->appPath.'::lang.admin.code_validate'),
            'code.discount_unique' => gp247_language_render($this->plugin->appPath.'::lang.discount_unique'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $dataInsert = [
            'code'       => $data['code'],
            'reward'     => (float)$data['reward'],
            'limit'      => $data['limit'],
            'type'       => $data['type'],
            'data'       => $data['data'],
            'login'      => empty($data['login']) ? 0 : 1,
            'status'     => empty($data['status']) ? 0 : 1,
        ];
        if(!empty($data['expires_at'])) {
            $dataInsert['expires_at'] = $data['expires_at'];
        }
        $dataInsert = gp247_clean($dataInsert, [], true);
        $discount = ShopDiscount::createDiscountAdmin($dataInsert);

        $shopStore        = $data['shop_store'] ?? [session('adminStoreId')];
        $discount->stores()->detach();
        if ($shopStore) {
            $discount->stores()->attach($shopStore);
        }

        return redirect()->route('admin_discount.index')->with('success', gp247_language_render($this->plugin->appPath.'::lang.admin.create_success'));

    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $discount = ShopDiscount::getDiscountAdmin($id);
        if (!$discount) {
            return redirect()->route('admin.data_not_found')->with(['url' => url()->full()]);
        }

        $data = [
            'title'             => gp247_language_render($this->plugin->appPath.'::lang.admin.edit'),
            'subTitle'          => '',
            'title_description' => '',
            'icon'              => 'fa fa-pencil-square-o',
            'discount'          => $discount,
            'url_action'        => gp247_route_admin('admin_discount.edit', ['id' => $discount['id']]),
            'appPath'           => $this->plugin->appPath,
        ];
        return view($this->plugin->appPath.'::Admin')
            ->with($data);
    }

    /**
     * update
     */
    public function postEdit($id)
    {
        $discount = ShopDiscount::getDiscountAdmin($id);
        if (!$discount) {
            return redirect()->route('admin.data_not_found')->with(['url' => url()->full()]);
        }
        $data = request()->all();
        $validator = Validator::make($data, [
            'code' => 'required|regex:/(^([0-9A-Za-z\-\._]+)$)/|discount_unique:' . $discount->id . '|string|max:50',
            'limit' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
            'type' => 'required',
        ], [
            'code.regex' => gp247_language_render($this->plugin->appPath.'::lang.admin.code_validate'),
            'code.discount_unique' => gp247_language_render($this->plugin->appPath.'::lang.discount_unique'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        //Edit
        $dataUpdate = [
            'code'       => $data['code'],
            'reward'     => (float)$data['reward'],
            'limit'      => $data['limit'],
            'type'       => $data['type'],
            'data'       => $data['data'],
            'login'      => empty($data['login']) ? 0 : 1,
            'status'     => empty($data['status']) ? 0 : 1,
        ];
        if(!empty($data['expires_at'])) {
            $dataUpdate['expires_at'] = $data['expires_at'];
        }
        $dataUpdate = gp247_clean($dataUpdate, [], true);
        $discount->update($dataUpdate);

        $shopStore        = $data['shop_store'] ?? [session('adminStoreId')];
        $discount->stores()->detach();
        if ($shopStore) {
            $discount->stores()->attach($shopStore);
        }
    
        return redirect()->route('admin_discount.index')
            ->with('success', gp247_language_render($this->plugin->appPath.'::lang.admin.edit_success'));

    }

    /*
    Delete list item
    Need mothod destroy to boot deleting in model
    */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => gp247_language_render('action.method_not_allow')]);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            $arrDontPermission = [];
            foreach ($arrID as $key => $id) {
                if(!$this->checkPermisisonItem($id)) {
                    $arrDontPermission[] = $id;
                }
            }
            if (count($arrDontPermission)) {
                return response()->json(['error' => 1, 'msg' => gp247_language_render('admin.remove_dont_permisison') . ': ' . json_encode($arrDontPermission)]);
            }
            ShopDiscount::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => gp247_language_render('action.remove_success')]);
        }
    }

    /**
     * Check permisison item
     */
    public function checkPermisisonItem($id) {
        return ShopDiscount::getDiscountAdmin($id);
    }
}
