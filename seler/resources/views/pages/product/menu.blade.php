<div class="card">
    <div class="card-header">
        <h5 class="card-title">Menus</h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <nav>
            <a href="{{url('/product/edit/'.$product->id)}}" class="nav-item d-block text-info">Product Detail</a>
            <a href="{{url('/product/image/'.$product->id)}}" class="nav-item d-block text-info">Product Image</a>
        </nav>
    </div>
    <div class="card-footer">
    </div>
</div>