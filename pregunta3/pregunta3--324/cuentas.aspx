<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="cuentas.aspx.cs" Inherits="pregunta3__324.WebForm2" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <link rel="stylesheet" href="estilos.css"/>  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <title>cuentas</title>
</head>
<body>
        
   <form runat="server">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <asp:Button runat="server" ID="btnCerrarSesion" Text="Cerrar sesión" CssClass="btn btn-danger" OnClick="btnCerrarSesion_Click" />
                        <div class="card-header">Datos de la cuenta</div>
                        <div class="card-body">
                            <div>
                                <asp:Literal runat="server" ID="mensajeadv" />

                            </div>
                            <br />
                            <div class="form-group" runat="server" id="divIdCuenta" visible="false">
                                <label for="txtID">Id Cuenta:</label>
                                <asp:TextBox runat="server" ID="txtID" ReadOnly="true" CssClass="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="id_us">Titular:</label>
                                <asp:TextBox runat="server" ID="txtTitular" ReadOnly="true" CssClass="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="txtFechaCreacion">Fecha de Creación:</label>
                                <asp:TextBox runat="server" ID="txtFechaCreacion" ReadOnly="true" CssClass="form-control" TextMode="DateTimeLocal" />
                            </div>

                            <div class="form-group" runat="server" id="divSaldo" visible="false">
                                <label for="saldo">Saldo:</label>
                                <asp:TextBox runat="server" ID="txtSaldo" ReadOnly="true" CssClass="form-control" />
                            </div>

                            <div class="form-group" runat="server" id="divMonto" visible="false">
                                <label for="monto">Monto a depositar o retirar:</label>
                                <asp:TextBox runat="server" ID="txtMonto" CssClass="form-control" Text="0" />
                            </div>

                            <div class="form-group" runat="server" id="divOperacion" visible="false">
                                <label for="operacion" class="form-label mt-4">Operación:</label>
                                <asp:DropDownList runat="server" ID="ddlOperacion" CssClass="form-control">
                                    <asp:ListItem Text="Depósito" Value="deposito" />
                                    <asp:ListItem Text="Retiro" Value="retiro" />
                                </asp:DropDownList>
                            </div>

                            <div class="form-group">
                                <label for="tipo" class="form-label mt-4">Tipo de cuenta:</label>
                                <asp:DropDownList runat="server" ID="ddlTipoCuenta" CssClass="form-control">
                                    <asp:ListItem Text="Caja de Ahorros" Value="ahorro" />
                                    <asp:ListItem Text="Cuenta Corriente" Value="corriente" />
                                    <asp:ListItem Text="Cuenta Mancomunada" Value="mancomunada" />
                                </asp:DropDownList>
                            </div>

                            <div class="btn-group" role="group" aria-label="">
                                <asp:Button runat="server" ID="btnAgregar" Text="Agregar" CssClass="btn btn-success" OnClick="btnAgregar_Click" />
                                <asp:Button runat="server" ID="btnModificar" Text="Modificar" CssClass="btn btn-warning" OnClick="btnModificar_Click" Enabled="false" />
                                <asp:Button runat="server" ID="btnCancelar" Text="Cancelar" CssClass="btn btn-info" OnClick="btnCancelar_Click" Enabled="false" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <asp:GridView ID="gvCuentas" runat="server" AutoGenerateColumns="False" OnRowCommand="gvCuentas_RowCommand" CssClass="table table-bordered">
                <Columns>
                    <asp:BoundField DataField="id" HeaderText="ID" />
                    <asp:BoundField DataField="saldo" HeaderText="Saldo" />
                    <asp:BoundField DataField="tipo" HeaderText="Tipo" />
                    <asp:BoundField DataField="fecha_cre" HeaderText="Fecha de Creación" />
                    <asp:TemplateField HeaderText="Acciones">
                        <ItemTemplate>
                            <asp:Button runat="server" ID="btnSeleccionar" CommandName="Seleccionar" CommandArgument='<%# Eval("id") %>' Text="Seleccionar" CssClass="btn btn-primary" />
                            <asp:Button runat="server" ID="btnBorrar" CommandName="Borrar" CommandArgument='<%# Eval("id") %>' Text="Borrar" CssClass="btn btn-danger" />
                        </ItemTemplate>
                    </asp:TemplateField>
                </Columns>
            </asp:GridView>
        </div>
    </form>
</body>
</html>
