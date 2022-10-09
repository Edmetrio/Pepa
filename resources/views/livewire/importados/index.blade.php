<div class="row shop_wrapper grid_4">
    @foreach($produtos as $p)
    <div class="col-lg-3 col-md-6 col-sm-6 col-custom product-area mb-20">
        <div class="single-product position-relative" style="border: 2px solid #0E6A3A; border-radius: 15px">
            <div class="product-image">
                <a class="d-block" href="{{Route('item',$p->id)}}">
                    <img src="assets/images/produto/{{$p->produtos->icon}}" alt="" class="product-image-1 w-100">
                </a>
            </div>
            <div class="product-content">
                <div class="product-title">
                    <h4 class="title-2"> <a href="{{Route('item',$p->produtos->id)}}">{{$p->produtos->nome}}</a></h4>
                </div>
                <div class="price-box">
                    <span class="regular-price ">{{$p->produtos->preco_retalho}} MZN</span>
                </div>
            </div>
            <div class="add-action d-flex position-absolute">
                <a href={{url("detalhes/$p->id")}} title="Adicionar na Carrinha">
                    <i class="ion-bag"></i>
                </a>
                <!-- <a href="#" title="Add To Wishlist">
                    <i class="ion-ios-heart-outline"></i>
                </a> -->
                <a href="#{{$p->produtos->nome}}" data-toggle="modal" title="Visão Rápida">
                    <i class="ion-eye"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>