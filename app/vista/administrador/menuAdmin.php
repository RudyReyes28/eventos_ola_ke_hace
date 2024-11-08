<div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false"
    data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Menu</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
            <li class="nav-item">
                <a href="vistaAdministrador.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>

            <li>
                <a  href="vistaAprobacionPublicacion.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-grid"></i>
                    <span class="ms-1 d-none d-sm-inline">Aprobaciones Pendientes</span>
                     <?php if ($cantidadAprobaciones > 0): ?>
                        <span class="badge rounded-pill bg-danger"><?= $cantidadAprobaciones ?></span>
                    <?php endif; ?> 
                </a>
            </li>

            <li>
                <a  href="vistaReportesPublicacion.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-grid"></i>
                    <span class="ms-1 d-none d-sm-inline">Reportes</span>
                     <?php if ($cantidadReportes > 0): ?>
                        <span class="badge rounded-pill bg-danger"><?= $cantidadReportes ?></span>
                    <?php endif; ?> 
                </a>
            </li>
            <li>
                <a href="../../controlador/autenticacion/CerrarSesion.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Cerrar Sesion</span> </a>
            </li>
        </ul>
    </div>
</div>