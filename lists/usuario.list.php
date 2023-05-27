<?php
require '../scripts/validarSession.php'; 
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/usuarioDTO.class.php";
require "../class/usuarioDAO.class.php";

$usuarioDTO = new usuarioDTO();
$usuarioDAO = new usuarioDAO($conexion);

$usuarios = $usuarioDAO->getAll();
?>
<script src="../public/js/deshabilitar.js"></script>
<table class="table table-striped">
    <thead class="text_center">
        <tr>
            <th scope="row">Nombre</th>
            <th scope="row">Email</th>
            <th scope="row">Estado</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($obj = $usuarios->fetch_object()){
            $usuarioDTO->map($obj);
        ?>

        <tr>
            <td scope="row"><?php echo $usuarioDTO->getNombre(); ?></td>
            <td scope="row"><?php echo $usuarioDTO->getEmail(); ?></td>
            <td scope="row"><?php echo $usuarioDTO->getEstado(); ?></td>
            <td>
                <a class="text-warning botonDeshabilitar" href="#" onclick="abrirPagina('forms/usuario.form.php','contenido','&id_usuario=<?php echo $usuarioDTO->getId_usuario();?>');"><i class="fas fa-edit"></i></a>
            </td>
            <td>
                <form action="./process/usuario.process.php" id="formEliminar<?php echo $usuarioDTO->getId_usuario();?>">
                    <input type="hidden" name='id_usuario' value="<?php echo $usuarioDTO->getId_usuario();?>">

                    <input type="hidden" name='modo' value='eliminar'>

                    <a class="text-danger botonDeshabilitar" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $usuarioDTO->getId_usuario();?>'),'',`abrirPagina('lists/usuario.php', 'contenido', '&id_usuario=<?php echo $usuarioDTO->getId_usuario();?>';`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>
        
        </tr>
                
        <?php
        }
        ?>
    </tbody>
</table>