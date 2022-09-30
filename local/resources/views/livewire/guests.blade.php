<div>
    <h6 class="mb-4">Tengo un amig@ que le puede interesar los productos Join Trust</h6>
    @foreach($inputs as $key => $input)
        <div class="row pt-1">
            <div class="col-6">
                <label for="input_{{$key}}_guest_name" class="form-label">Nombre completo</label>
                <input type="text" id="input_{{$key}}_guest_name" wire:model.defer="inputs.{{$key}}.guest_name" class="form-control">
                @error('inputs.'.$key.'.guest_name') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                @enderror
            </div>
            <div class="col-5">
                <label for="input_{{$key}}_guest_phone" class="form-label">Celular</label>
                <input type="text" id="input_{{$key}}_guest_phone" wire:model.defer="inputs.{{$key}}.guest_phone" class="form-control">
                @error('inputs.'.$key.'.guest_phone') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-1">
                <div wire:click="removeInput({{$key}})" class="flex items-center justify-end text-red-600 text-sm w-full cursor-pointer" style="top: 55%;position: relative;">
                    <a class="item-delete text-danger"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="flex text-center justify-center py-4">
        <a wire:click="addInput" class="text-secondary"> <i class="fas fa-cart-plus"></i> Agregar otro amigo </a>
    </div>
    <div class="row">
        <span class="small text-secondary mt-3" style="font-size: 0.75em;"> * Recuerda avisarle a tus amig@s que los vamos a contactar, no queremos incomodarl@s. Entre más referidos nos des, más beneficios recibes.</span>
    </div>
    <div class="d-flex justify-content-end py-4">
        <button wire:click="save" class="btn btn-secondary">Enviar amigos</button>
        <button wire:click="skip" type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
    </div>
</div>
