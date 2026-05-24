<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="propertie[titulo]" placeholder="Titulo Propiedad" value="<?= sanitize($propertie->titulo); ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propertie[precio]" placeholder="Precio Propiedad" value="<?= sanitize($propertie->precio); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="propertie[imagen]" accept="image/jpeg, image/png">

            <?php if($propertie->imagen): ?>
                <img src="../../images/<?= $propertie->imagen; ?>" alt="" class="imagen-small">
            <?php endif; ?>

            <label for="descripcion">Descripcion</label>
            <textarea name="propertie[descripcion]" id="descripcion"><?= sanitize($propertie->descripcion); ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="propertie[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->habitaciones); ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="propertie[wc]" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->wc); ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="propertie[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->estacionamiento); ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            
            <label for="vendedor">Vendedor</label>
            <select name="propertie[vendedorId]" id="vendedor">
                <option value="">--Seleccione--</option>
                <?php foreach($vendedores as $vendedor): ?>
                    <option <?php  echo $propertie->vendedorId === $vendedor->id ? 'selected' : ''; ?> value="<?=  sanitize($vendedor->id); ?>"> <?= sanitize($vendedor->nombre). " ". sanitize($vendedor->apellido); ?> </option>
                <?php endforeach; ?>
            </select>

        </fieldset>