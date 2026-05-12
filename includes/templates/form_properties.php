<fieldset>
            <legend>Informacion General</legend>

            <label for="title">Titulo:</label>
            <input type="text" id="title" name="title" placeholder="Titulo Propiedad" value="<?= sanitize($propertie->title); ?>">

            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?= sanitize($propertie->price); ?>">

            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png">

            <label for="description">Descripcion</label>
            <textarea name="description" id="description"><?= sanitize($propertie->description); ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="rooms">Habitaciones:</label>
            <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->rooms); ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->wc); ?>">

            <label for="parking">Estacionamiento:</label>
            <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9" value="<?= sanitize($propertie->parking); ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="sellers_id" id="seller">
                <option value="">--Seleccione--</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option <?= $seller === $row['id'] ? 'selected' : ''; ?> value="<?= sanitize($row['id']); ?>"><?= $propertie->row['name'] . " " . $row['last_name']; ?></option>

                <?php endwhile; ?>
            </select>

        </fieldset>