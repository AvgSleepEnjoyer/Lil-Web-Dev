<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="vendedor[apellidos]" placeholder="Apellidos Vendedor" value="<?php echo s($vendedor->apellidos); ?>">
    
</fieldset>
<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>