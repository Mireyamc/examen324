using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace pregunta3__324
{
    public partial class WebForm2 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                int? userId = Session["UserId"] as int?;
                if (userId.HasValue)
                {
                    string nomb = Session["NomeUs"] as string;
                    mensajeadv.Text = " ";
                    if (!string.IsNullOrEmpty(nomb))
                    {
                        txtTitular.Text = nomb;
                    }

                    if (string.IsNullOrEmpty(txtFechaCreacion.Text))
                    {
                        txtFechaCreacion.Text = DateTime.Now.ToString("yyyy-MM-ddTHH:mm");
                    }
                    DataTable dtCuentas = Cuentas(userId);
                    gvCuentas.DataSource = dtCuentas;
                    gvCuentas.DataBind();
                    
                }
                else
                {
                    Response.Redirect("inicio.aspx");
                }

               
            }
            
        }

        protected void btnAgregar_Click(object sender, EventArgs e)
        {

            int? userId = Session["UserId"] as int?;
            DateTime fechaCreacion = DateTime.Now;
            string tipoCuenta = ddlTipoCuenta.SelectedValue;
            string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlConnection con = new SqlConnection(connectionString);
            con.Open();
            mensajeadv.Text = "Los datos se han enviado correctamente.";
            SqlCommand cmd = new SqlCommand("INSERT INTO cuenta (tipo, fecha_cre, id_us, activo) VALUES (@tipo, @fecha, @idus, 1)", con);
            cmd.Parameters.AddWithValue("@idus", userId);
            cmd.Parameters.AddWithValue("@fecha", fechaCreacion);
            cmd.Parameters.AddWithValue("@tipo", tipoCuenta);
            cmd.ExecuteNonQuery();
            Response.Redirect(Request.Url.AbsoluteUri);

        }

        protected void btnModificar_Click(object sender, EventArgs e)
        {
            int idCuenta = Convert.ToInt32(txtID.Text);
            decimal saldoActual = Convert.ToDecimal(txtSaldo.Text);
            string tipoCuenta = ddlTipoCuenta.SelectedValue;
            DateTime fechaCreacion = DateTime.Parse(txtFechaCreacion.Text);
            decimal monto = Convert.ToDecimal(txtMonto.Text);
            string operacion = ddlOperacion.SelectedValue;
            if (operacion == "retiro" && saldoActual < monto)
            {
                mensajeadv.Text = "El saldo actual es menor que el monto que deseas retirar. Operación no permitida.";
                return;
            }
            ActualizarCuenta(idCuenta, saldoActual, tipoCuenta, fechaCreacion, monto, operacion);
            Response.Redirect(Request.Url.AbsoluteUri);
        }

        protected void btnCancelar_Click(object sender, EventArgs e)
        {
            Response.Redirect(Request.Url.AbsoluteUri);
        }
        public DataTable Cuentas(int? usId)
        {
            SqlConnection con = new SqlConnection();
            con.ConnectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlDataAdapter ada = new SqlDataAdapter();
            ada.SelectCommand = new SqlCommand();
            ada.SelectCommand.Connection = con;
            ada.SelectCommand.CommandText = "SELECT * FROM cuenta WHERE id_us = @usId AND activo=1";
            ada.SelectCommand.Parameters.AddWithValue("@usId", usId);
            DataSet ds = new DataSet();
            DataTable dt = new DataTable();
            ada.Fill(ds, "Cuenta");
            dt = ds.Tables["Cuenta"];
            return dt;
        }
        protected void gvCuentas_RowCommand(object sender, GridViewCommandEventArgs e)
        {
            int idCuenta = Convert.ToInt32(e.CommandArgument);

                if (e.CommandName == "Seleccionar")
                {
                    DataRow cuentaSeleccionada = ObtenerDatosCuentaPorId(idCuenta);

                    if (cuentaSeleccionada != null)
                    {
                        mensajeadv.Text = " ";
                        divIdCuenta.Visible = true;
                        divSaldo.Visible = true;
                        divMonto.Visible = true;
                        divOperacion.Visible = true;
                        txtID.Text = cuentaSeleccionada["id"].ToString();
                        txtSaldo.Text = cuentaSeleccionada["saldo"].ToString();
                        ddlTipoCuenta.SelectedValue = cuentaSeleccionada["tipo"].ToString();
                        DateTime fechaCreacion;
                        if (DateTime.TryParse(cuentaSeleccionada["fecha_cre"].ToString(), out fechaCreacion))
                        {  
                            txtFechaCreacion.Text = fechaCreacion.ToString("yyyy-MM-ddTHH:mm");
                        }
                        btnModificar.Enabled = true;
                        btnCancelar.Enabled = true;
                        btnAgregar.Enabled = false;                    }
                }
            else if (e.CommandName == "Borrar")
            {
                decimal saldoCuenta = ObtenerSaldoCuentaPorId(idCuenta);
                if (saldoCuenta != 0)
                {
                    mensajeadv.Text = "La cuenta no puede borrarse mientras aun qede saldo";
                }
                else
                {
                    string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
                    SqlConnection con = new SqlConnection(connectionString);
                    con.Open();
                    SqlCommand cmd = new SqlCommand("UPDATE cuenta SET activo = 0 WHERE id = @idCuenta", con);
                    cmd.Parameters.AddWithValue("@idCuenta", idCuenta);
                    cmd.ExecuteNonQuery();
                    con.Close();
                    Response.Redirect(Request.Url.AbsoluteUri);
                }

               
            }
        }
        private DataRow ObtenerDatosCuentaPorId(int idCuenta)
        {
            string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlConnection con = new SqlConnection(connectionString);
            string query = "SELECT * FROM cuenta WHERE id = @idCuenta";
            SqlDataAdapter ada = new SqlDataAdapter(query, con);
            ada.SelectCommand.Parameters.AddWithValue("@idCuenta", idCuenta);
            DataSet ds = new DataSet();
            ada.Fill(ds, "Cuenta");
            DataTable dt = ds.Tables["Cuenta"];
            if (dt.Rows.Count > 0)
            {
                return dt.Rows[0];
            }
            return null;
        }
        private decimal ObtenerSaldoCuentaPorId(int idCuenta)
        {
            string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlConnection con = new SqlConnection(connectionString);
            con.Open();
            string query = "SELECT saldo FROM cuenta WHERE id = @idCuenta";
            SqlCommand cmd = new SqlCommand(query, con);
            cmd.Parameters.AddWithValue("@idCuenta", idCuenta);
            object result = cmd.ExecuteScalar();
            con.Close();
            return result != null ? Convert.ToDecimal(result) : 0;
        }
        private void ActualizarCuenta(int idCuenta, decimal saldoActual, string tipoCuenta, DateTime fechaCreacion, decimal monto, string operacion)
        {
            int idUsuario = Convert.ToInt32(Session["UserId"]);
            string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlConnection con = new SqlConnection(connectionString);
            string query = "UPDATE cuenta SET saldo = @nuevoSaldo, tipo = @nuevoTipo, fecha_cre = @nuevaFechaCreacion WHERE id = @idCuenta";
            SqlCommand cmd = new SqlCommand(query, con);
            decimal nuevoSaldo = saldoActual;
            if (operacion == "deposito")
            {
                nuevoSaldo += monto;
            }
            else if (operacion == "retiro")
            {
                nuevoSaldo -= monto;
            }
            cmd.Parameters.AddWithValue("@idCuenta", idCuenta);
            cmd.Parameters.AddWithValue("@nuevoSaldo", nuevoSaldo);
            cmd.Parameters.AddWithValue("@nuevoTipo", tipoCuenta);
            cmd.Parameters.AddWithValue("@nuevaFechaCreacion", fechaCreacion);         
            SqlCommand cmdRegistro = new SqlCommand("INSERT INTO transaccion (id_cuenta, id_us, fecha_h, tipo, monto) VALUES (@idCuenta, @idUsuario, @fechaOperacion, @operacion, @monto)", con);
            cmdRegistro.Parameters.AddWithValue("@idCuenta", idCuenta);
            cmdRegistro.Parameters.AddWithValue("@idUsuario", idUsuario);
            cmdRegistro.Parameters.AddWithValue("@fechaOperacion", DateTime.Now);
            cmdRegistro.Parameters.AddWithValue("@operacion", operacion);
            cmdRegistro.Parameters.AddWithValue("@monto", monto);
            con.Open();
            cmdRegistro.ExecuteNonQuery();
            cmd.ExecuteNonQuery();
            con.Close();
        }
        protected void btnCerrarSesion_Click(object sender, EventArgs e)
        {
            Session.Clear();
            Response.Redirect("inicio.aspx");
        }


    }
}