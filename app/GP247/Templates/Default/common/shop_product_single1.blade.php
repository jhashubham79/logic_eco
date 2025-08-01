<article class="product wow fadeInRight">
    <div class="product-body">
      <div class="product-figure">
          <a href="{{ $item->id }}">
          <img src="" alt="{{ $item->name ?? $item->title ?? '' }}"/>
          </a>
      </div>
      <h5 class="product-title"><a href="{{ $item->id }}">{{ $item->name ?? $item->title ?? '' }}</a></h5>
    </div>
</article>