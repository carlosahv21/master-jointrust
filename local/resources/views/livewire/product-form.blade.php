<div>
    <div class="row align-items-start p-2">
        <div class="col-6 p-2">
            <label for="inputNombre" class="form-label">Nombre del producto<span class="text-danger"> *</span></label>
            <input wire:model="name" type="text" class="form-control" placeholder="Ej: Fresa" id="inputNombre">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        <div class="col-6 p-2">
            <label for="inputReferencia" class="form-label">Referencia <span class="text-danger"> *</span></label>
            <input wire:model="reference" type="text" class="form-control" placeholder="Ej: tipo 1" id="inputReferencia">
            @if ($errors->has('reference'))
                <div class="invalid-feedback">
                    {{ $errors->first('reference') }}
                </div>
            @endif
        </div>
        <div class="col-6 p-2">
            <label for="inputPresentation" class="form-label">Presentación  <span class="text-danger"> *</span></label>
            <input wire:model="presentation" type="text" class="form-control" placeholder="Ej: gramos" id="inputPresentation">
            @if ($errors->has('presentation'))
                <div class="invalid-feedback">
                    {{ $errors->first('presentation') }}
                </div>
            @endif
        </div>
        <div class="col-6 p-2">
            <label for="inputPrecio" class="form-label">Precio <span class="text-danger"> *</span></label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input wire:model="price" type="text" class="form-control" placeholder="Ej: 100000" id="inputPrecio">
              </div>
            @if ($errors->has('price'))
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
            @endif
        </div>
        <div class="col-12 p-2">
            <label for="inputStock" class="form-label">Stock <span class="text-danger"> *</span></label>
            <input wire:model="stock" type="number" class="form-control" placeholder="Ej: 100" id="inputStock">
            @if ($errors->has('stock'))
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
            @endif
        </div>
        <div class="col-12 p-2">
            <div class="d-xl-flex align-items-center">
                <div>
                    @if ( $fileProducts )
                        <img class="rounded avatar-xl" src="{{ $fileProducts->temporaryUrl() }}" alt="cambia tu foto">
                    @elseif($this->seeFileProducts)
                        <img class="rounded avatar-xl" src="{{ asset('local/storage/app/images_products/'.$this->seeFileProducts) }}" alt="cambia tu foto">
                    @else
                        <img class="rounded avatar-xl" src="{{ asset('public/assets/img/updivision.png')}}" alt="cambia tu foto">
                    @endif
                    
                    
                </div>
                <div class="file-field">
                    <div class="d-flex justify-content-xl-center ms-xl-3">
                        <div class="d-flex">
                            <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path></svg>
                            <input type="file" wire:model="fileProducts">
                            <div class="d-md-block text-left">
                                <div class="fw-normal text-dark mb-1">Escoge una imagen</div>
                                <div class="text-gray small">JPG, GIF or PNG. Maximo 5MB</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            @if ($errors->has('fileProducts'))
                <div class="invalid-feedback">
                    {{ $errors->first('fileProducts') }}
                </div>
            @endif
        </div>
        <div class="col-12 p-2">
            <div class="form-check">
                <input wire:model="favorite" class="form-check-input" type="checkbox" value="" id="inputFavorite">
                <label class="form-check-label" for="inputFavorite">
                    Agregar a favorito
                </label>
            </div>
        </div>
        <div class="d-flex justify-content-end py-4">
            <button wire:click="save" class="btn btn-secondary">Guardar</button>
            <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
