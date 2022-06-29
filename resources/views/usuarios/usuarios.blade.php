@extends('layouts.layout')
@section('title', 'Usuarios')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-5 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-user text-rosado"></i> <b>Formulario de usuarios</b>
                </div>
                <div class="card-body">
                    <form id="frm-Class">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Nombre" name="name" />
                            <label for="profesor">Nombre <b class="text-rosado">*</b></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Apellidos" name="name" />
                            <label for="profesor">Apellidos <b class="text-rosado">*</b></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="name" />
                            <label for="profesor">Email <b class="text-rosado">*</b></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="name" />
                            <label for="profesor">Password <b class="text-rosado">*</b></label>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="" id="" class="form-select">
                                <option value="">Administrador</option>
                                <option value="">Recursos humanos</option>
                                <option value="">Flujo de caja</option>
                            </select>
                            <label for="profesor">Rol <b class="text-rosado">*</b></label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">Ingresar
                                clase</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-list text-rosado"></i> <b>Lista de usuarios</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm" id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm" id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm" id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daniel</td>
                                    <td>Usuga Moreno</td>
                                    <td class="text-center">Administrador</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-ver-clase">
                                            <i class="fas fa-eye" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-edit-clase">
                                            <i class="fas fa-edit" style="pointer-events: none"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-table border-0 btn-sm"
                                            id="btn-delete-clase">
                                            <i class="fas fa-times" style="pointer-events: none"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
