<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="seller[nombre]" placeholder="nombre vendedor" value="<?= sanitize($seller->nombre); ?>">


    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="seller[apellido]" placeholder="apellido vendedor" value="<?= sanitize($seller->apellido); ?>">


</fieldset>


<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Telefono: </label>
    <input type="number" id="telefono" name="seller[telefono]" placeholder="telefono vendedor" value="<?= sanitize($seller->telefono); ?>">
</fieldset>