<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

            <?php if($propiedad->imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
            <?php endif; ?>
            
            
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="3" value="<?php echo s($propiedad->habitaciones); ?>" min="1" max="10">

            <label for="wc">wc:</label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="3" value="<?php echo s($propiedad->wc); ?>" min="1" max="10">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="3" 
            value="<?php echo s($propiedad->estacionamiento); ?>" min="1" max="10">
        
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            
            <select name="propiedad[vendedores_ID]" id="vendedor">
                <option value="" disabled selected>--Seleccione--</option>
                <?php foreach($vendedores as $vendedor) : ?>
                    <option 
                    <?php echo $propiedad->vendedores_ID === $vendedor->id ? "selected" : ""; ?>
                    value="<?php echo s($vendedor->id) ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellidos) ?></option>
                <?php endforeach; ?>
                
            </select>
        </fieldset>