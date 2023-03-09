using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.IO;
using System.Text;
using iTextSharp.text;
using iTextSharp.text.pdf;
using iTextSharp.text.html.simpleparser;

public partial class Administracao_cadastro_anuncio : System.Web.UI.Page
{
    WebService ws = new WebService();
    DateTime v_data;
    double v_valor;
    string nome_arquivo="",v_cpf_cnpj="";
    Int32 v_codigo_cliente = 0, v_codigo_receber = 0;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            lblHash.Visible = false;
            if (Session["hash"] != null)
            {
                lblHash.Text = Session["hash"].ToString();
                lblCodigo.Text = "0";
            }
            else
            {
                //Response.Redirect("login.aspx");
                lblCodigo.Text = "0";

            }
        }
    }

    protected void btnIncluir_Click(object sender, EventArgs e)
    {
        ObjectDataSource1.Insert();
        ObjectDataSource1.Select();

        string myScript = @"alert('Registro Incluido!');";
        ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);

    }

    protected void grdDados_RowDeleting(object sender, GridViewDeleteEventArgs e)
    {
        int index = e.RowIndex;
        int codigo = Convert.ToInt32(((Label)grdDados.Rows[index].FindControl("lblCodigo")).Text);
        lblCodigo.Text = codigo.ToString();
    }

    protected void grdDados_RowCommand(object sender, GridViewCommandEventArgs e)
    {
        if (e.CommandName == "Select")
        {

            WebControl wc = ((WebControl)e.CommandSource);
            GridViewRow row = ((GridViewRow)wc.NamingContainer);

            lblCodigo.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigo")).Text;
            ddlCliente.SelectedValue = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigoCliente")).Text;
            txtVencimento.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblVencimento")).Text;
            if (txtVencimento.Text != string.Empty)
            {
                v_data = Convert.ToDateTime(txtVencimento.Text);
                txtVencimento.Text = String.Format("{0:MM/dd/yyyy}", v_data);
            }
            txtDocumento.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblDocumento")).Text;
            txtValor.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblValor")).Text;
            if (txtValor.Text != string.Empty)
            {
                v_valor = Convert.ToDouble(txtValor.Text);
                txtValor.Text = String.Format("{0:0.00}", v_valor);
                txtValor.Text = txtValor.Text.ToString().Replace(",", ".");
            }
            lblNossoNumero.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblNossoNumero")).Text;

            hlBoleto.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblBoleto")).Text;
            hlBoleto.Attributes["href"] = Page.ResolveUrl("~/Administracao/Boleto/" + hlBoleto.Text + ".html");
            txtObservacao.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblObservacao")).Text;
            ddlStatus.SelectedValue = ((DropDownList)grdDados.Rows[row.RowIndex].FindControl("ddlStatus")).SelectedValue;
        }

        if (e.CommandName == "Gerar")
        {
            WebControl wc = ((WebControl)e.CommandSource);
            GridViewRow row = ((GridViewRow)wc.NamingContainer);

            v_codigo_receber = Convert.ToInt32(((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigo")).Text);
            v_codigo_cliente = Convert.ToInt32(((Label)grdDados.Rows[row.RowIndex].FindControl("lblCodigoCliente")).Text);
            v_valor = Convert.ToDouble(((Label)grdDados.Rows[row.RowIndex].FindControl("lblValor")).Text);

            DataSet dados = ws.ConsultaCliente(v_codigo_cliente, "0");            

            //'Informa os dados do cedente
            BoletoNet.Cedente c = new BoletoNet.Cedente("10.624.585/0001-74", "TEM NA REDE PROVEDORES LTDA", "4195", "5", "95338", "8");
            //'Dependendo da carteira, é necessário informar o código do cedente (o banco que fornece)
            //c.Codigo = Convert.ToInt32(txtCodigoCedente.Text);

            //'Dados para preenchimento do boleto (data de vencimento, valor, carteira e nosso número)
            txtVencimento.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblVencimento")).Text;
            if (txtVencimento.Text != string.Empty)
            {
                v_data = Convert.ToDateTime(txtVencimento.Text);
                txtVencimento.Text = String.Format("{0:dd/MM/yyyy}", v_data);
            }
            txtValor.Text = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblValor")).Text;
            if (txtValor.Text != string.Empty)
            {
                v_valor = Convert.ToDouble(txtValor.Text);
                txtValor.Text = String.Format("{0:0.00}", v_valor);
                txtValor.Text = txtValor.Text.ToString().Replace(",", ".");
            }

            BoletoNet.Boleto b = new BoletoNet.Boleto(v_data, v_valor, "16", "00000333271", c);

            txtValor.Text = "";
            txtVencimento.Text = "";

            //'Dependendo da carteira, é necessário o número do documento
            b.NumeroDocumento = ((Label)grdDados.Rows[row.RowIndex].FindControl("lblDocumento")).Text;

            if (dados.Tables[0].Rows[0]["cnpj"].ToString() != string.Empty)
                v_cpf_cnpj = dados.Tables[0].Rows[0]["cnpj"].ToString();
            else
                v_cpf_cnpj = dados.Tables[0].Rows[0]["cpf"].ToString();

            //'Informa os dados do sacado
            b.Sacado = new BoletoNet.Sacado(v_cpf_cnpj, dados.Tables[0].Rows[0]["razao_social"].ToString());
            b.Sacado.Endereco.End = dados.Tables[0].Rows[0]["endereco"].ToString();
            b.Sacado.Endereco.Bairro = dados.Tables[0].Rows[0]["bairro"].ToString();
            b.Sacado.Endereco.Cidade = dados.Tables[0].Rows[0]["cidade"].ToString();
            b.Sacado.Endereco.CEP = dados.Tables[0].Rows[0]["cep"].ToString();
            b.Sacado.Endereco.UF = "PR";

            BoletoNet.Instrucao_BancoBrasil i = new BoletoNet.Instrucao_BancoBrasil();
            i.Descricao = "Não Receber após o vencimento";
            b.Instrucoes.Add(i);

            //'Espécie do Documento - [R] Recibo
            b.EspecieDocumento = new BoletoNet.EspecieDocumento_BancoBrasil();

            BoletoNet.BoletoBancario bb = new BoletoNet.BoletoBancario();
            bb.CodigoBanco = 01; //'-> Referente ao código do Banco do Brasil
            bb.Boleto = b;
            bb.MostrarCodigoCarteira = true;
            bb.Boleto.Valida();

            nome_arquivo = "B" + v_cpf_cnpj + String.Format("{0:ddMMyyyy}", v_data);
            nome_arquivo = nome_arquivo.Replace("/", "");
            nome_arquivo = nome_arquivo.Replace(".", "");
            nome_arquivo = nome_arquivo.Replace("-", "");
            nome_arquivo = nome_arquivo.Trim();


            bb.MostrarComprovanteEntrega = true;

            if (panelBoleto.Controls.Count == 0)
                panelBoleto.Controls.Add(bb);

            bb.MontaHtmlNoArquivoLocal(Server.MapPath(".") + "/boleto/" + nome_arquivo+".html");
            
            ws.AtualizaContaReceber(v_codigo_receber, nome_arquivo, "00000333271");

            string imagePath = GerarImagem(nome_arquivo);
            imagePath = Server.MapPath(".") + "/boleto/" + nome_arquivo + ".jpg";

            string pdfPath = Server.MapPath(".") + "/boleto/" + nome_arquivo + ".pdf";

            Document doc = new Document();
            try
            {
                PdfWriter.GetInstance(doc, new FileStream(pdfPath, FileMode.Create));
                doc.Open();
                iTextSharp.text.Image gif = iTextSharp.text.Image.GetInstance(imagePath);
                //gif.ScaleAbsolute(520f, 624f);
                gif.ScaleToFit(800, 600);
                doc.Add(gif);
            }
            catch (DocumentException dex)
            {

            }
            catch (IOException ioex)
            {

            }
            catch (Exception ex)
            {

            }
            finally
            {
                doc.Close();
            }

            string myScript = @"alert('Boleto Gerado!');";
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);


            ObjectDataSource1.Select();

        }

    }

    protected void grdDados_RowDataBound(object sender, GridViewRowEventArgs e)
    {
        DataRowView dbr = (DataRowView)e.Row.DataItem;

        if (e.Row.RowType == DataControlRowType.DataRow)
        {
            Label lblCodigoAnunciante = (Label)e.Row.FindControl("lblCodigoCliente");
            DataSet dados =  ws.ConsultaCliente(Convert.ToInt32(lblCodigoAnunciante.Text), "");
            Label lblAnunciante = (Label)e.Row.FindControl("lblAnunciante");            
            lblAnunciante.Text = dados.Tables[0].Rows[0]["nome_fantasia"].ToString();

        }
    }

    protected void ObjectDataSource1_Deleting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        e.InputParameters["codigo"] = lblCodigo.Text;
        lblCodigo.Text = "0";
    }

    protected void ObjectDataSource1_Inserting(object sender, ObjectDataSourceMethodEventArgs e)
    {
        if (lblCodigo.Text == "0")
            e.InputParameters["codigo"] = 0;
        else
            e.InputParameters["codigo"] = Convert.ToInt32(lblCodigo.Text);

        e.InputParameters["codigo_cliente"] = ddlCliente.SelectedValue;

        e.InputParameters["vencimento"] = Convert.ToDateTime(txtVencimento.Text);
        e.InputParameters["valor"] = txtValor.Text;
        e.InputParameters["nosso_numero"] = lblNossoNumero.Text;
        e.InputParameters["documento"] = txtDocumento.Text;
        e.InputParameters["observacao"] = txtObservacao.Text;
        e.InputParameters["boleto"] = hlBoleto.Text;
        e.InputParameters["status"] = ddlStatus.SelectedValue;
    }

    protected void btnSalvar_Click(object sender, EventArgs e)
    {
        ObjectDataSource1.Insert();
        ObjectDataSource1.Select();

        string myScript = @"alert('Registro Salvo!');";
        ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
    }

    protected void ImageButton1_Click(object sender, ImageClickEventArgs e)
    {
        Response.Redirect("Default.aspx");

    }

    protected void ObjectDataSource1_Selecting(object sender, ObjectDataSourceSelectingEventArgs e)
    {
        e.InputParameters["codigo"] = "0";
        if (txtPesquisa.Text == "")
            e.InputParameters["nome"] = "0";
        else
            e.InputParameters["nome"] = txtPesquisa.Text;
    }

    protected void btnPesquisar_Click1(object sender, EventArgs e)
    {
        if (txtPesquisa.Text != "")
        {
            grdDados.DataBind();
            ObjectDataSource1.Select();
        }
        else
        {
            string myScript = @"alert('Digite um valor no campo pesquisa!');";
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>" + myScript + "</script>", false);
        }
        

    }

    protected void btnRefresh_Click(object sender, ImageClickEventArgs e)
    {
        txtPesquisa.Text = "";
        grdDados.DataBind();
        ObjectDataSource1.Select();

    }
    protected void grdDados_SelectedIndexChanged(object sender, EventArgs e)
    {

    }

    protected void btnRelatorioAtivos_Click(object sender, EventArgs e)
    { 


    }

    private string GerarImagem(string nome_arquivo)
    {
        string address = Server.MapPath(".") + "/boleto/" + nome_arquivo+".html";
        int width = 1536;
        int height = 2048;

        int webBrowserWidth = 670;
        int webBrowserHeight = 1000;

        System.Drawing.Bitmap bmp = WebsiteThumbnailImageGenerator.GetWebSiteThumbnail(address, webBrowserWidth, webBrowserHeight, width, height);

        string file = Server.MapPath(".") + "/boleto/" + nome_arquivo+".bmp";

        bmp.Save(file);

        using (System.Drawing.Image img = System.Drawing.Image.FromFile(Server.MapPath(".") + "/boleto/" + nome_arquivo+".bmp"))
        {
            img.Save(Server.MapPath(".") + "/boleto/" + nome_arquivo+".jpg", System.Drawing.Imaging.ImageFormat.Jpeg);
        }
        return file;
    }

}