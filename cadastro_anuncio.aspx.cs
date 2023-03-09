using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Net;
using System.Net.Mail;

public partial class cadastro_anuncio : System.Web.UI.Page
{
    private string message="";

    protected void Page_Load(object sender, EventArgs e)
    {
    }

    protected void btnEnviar_Click(object sender, EventArgs e)
    {
        if (ckAceito.Checked)
        {
            string tipo_pessoa = "", anuncio = "";
            if (ckPessoaFisica.Checked)
                tipo_pessoa = "Pessoa Física";
            if (ckPessoaJuridica.Checked)
                tipo_pessoa = "Pessoa Jurídica";

            if (ckClubeOfertas.Checked)
                anuncio += "Clube Ofertas </br>";
            if (ckTvOnline.Checked)
                anuncio += "TV Online </br>";
            if (ckTema.Checked)
                anuncio += "Vitrine Tema Infantil </br>";
            if (ckConvite.Checked)
                anuncio += "Vitrine Convite / Lembrancinhas </br>";
            if (ckBannerPublicidade.Checked)
                anuncio += "Banner Publicidade </br>";
            if (ckBannerTopo.Checked)
                anuncio += "Banner Topo </br>";
            if (ckBannerCentral.Checked)
                anuncio += "Banner Central </br>";
            if (ckMateriaHome.Checked)
                anuncio += "Matéria Home </br>";
            if (ckMateriaTema.Checked)
                anuncio += "Matéria Vitrine Tema Infantil </br>";
            if (ckMateriaConvite.Checked)
                anuncio += "Matéria Vitrina Convinte / Lembrancinhas </br>";
            if (ckHotSiteBasico.Checked)
                anuncio += "Criação Hot Site Básico </br>";
            if (ckHotSiteIntermediario.Checked)
                anuncio += "Criação Hot Site Intermedário </br>";
            if (ckHotSiteAvancado.Checked)
                anuncio += "Criação Hot Site Avançado </br>";


            message += " ";
            message += "<table style='width:600px;' border='0' cellspacing='0' cellpadding='0'>";
            message += "<tr>";
            message += "<td>";
            message += "<b><font face='Verdana'>Cadastro financeiro</font></b>";
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += tipo_pessoa;
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Razão Social / Nome</font>";
            message += "</td>";
            message += txtRazaoSocial.Text;
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Nome Fantasia (anuncio)</font>";
            message += "</td>";
            message += "<td>";
            message += txtNomeFantasia.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>CNPJ / CPF</font>";
            message += "</td>";
            message += "<td>";
            message += txtCnpjCpf.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Inscrição Estadual / RG</font>";
            message += "</td>";
            message += "<td>";
            message += txtIncricaoEstadualRG.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Endereço Financeiro</font>";
            message += "</td>";
            message += "<td>";
            message += txtEnderecoFinanceiro.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Bairro</font>";
            message += "</td>";
            message += "<td>";
            message += txtBairro.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Cidade / Estado</font>";
            message += "</td>";
            message += "<td>";
            message += txtCidadeEstado.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>CEP</font>";
            message += "</td>";
            message += "<td>";
            message += txtCep.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Responsável</font>";
            message += "</td>";
            message += "<td>";
            message += txtResponsavel.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>E-mail</font>";
            message += "</td>";
            message += "<td>";
            message += txtEmail.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Telefone</font>";
            message += "</td>";
            message += "<td>";
            message += txtTelefone.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<b><font face='Verdana'>Cadastro comercial para o anuncio CLASSIFICADO ON-LINE</font></b>";
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Nome Fantasia</font>";
            message += "</td>";
            message += "<td>";
            message += txtNomeFantasiaC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Bairro </font>";
            message += "</td>";
            message += "<td>";
            message += txtBairroC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Cidade</font>";
            message += "</td>";
            message += "<td>";
            message += txtCidadeC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Endereço</font>";
            message += "</td>";
            message += "<td>";
            message += txtEnderecoC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Telefone</font>";
            message += "</td>";
            message += "<td>";
            message += txtTelefoneC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>E-mail</font>";
            message += "</td>";
            message += "<td>";
            message += txtEmailC.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Site</font>";
            message += "</td>";
            message += "<td>";
            message += txtSite.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<p style='margin-top: 0; margin-bottom: 0'>";
            message += "<font face='Verdana' size='2'>Citar as categorias</font>";
            message += "</p>";
            message += "<p style='margin-top: 0; margin-bottom: 0'>";
            message += "<font face='Verdana' size='2'>em que seu anuncio</font>";
            message += "</p>";
            message += "<p style='margin-top: 0; margin-bottom: 0'>";
            message += "<font face='Verdana' size='2'>deverá ser incluída</font>";
            message += "</p>";
            message += "</td>";
            message += "<td>";
            message += txtCategoria.Text;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<b><font face='Verdana'>Anúncios adicionais</font></b>";
            message += "</td>";
            message += "<td>";
            message += anuncio;
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "</td>";
            message += "<td>";
            message += "</td>";
            message += "</tr>";
            message += "<tr>";
            message += "<td>";
            message += "<font face='Verdana' size='2'>Observação</font>";
            message += "</td>";
            message += "<td>";
            message += txtObservacao.Text;
            message += "</td>";
            message += "</tr>";
            message += "</table>";


            // cria o objeto de mensagem de e-mail
            MailMessage objEmail = new MailMessage();

            // remetente do e-mail
            objEmail.From = new System.Net.Mail.MailAddress("Cadastro Guia de Festas" + "<" + "cadastro@guiadefestascuritiba.com.br" + ">"); 
            // responder para 
            //objEmail.ReplyTo = new MailAddress("email@docliente.com.br");

            //destinatários do e-mail 
            objEmail.To.Add("cadastro@guiadefestascuritiba.com.br");
            //objEmail.To.Add("teste2@email.com.br");
            // veja que podemos adicionar quantos e-mails desejarmos como destino, para isto, repita a linha acima modificando o e-mail

            // cópia oculta da mensagem
            //objEmail.Bcc.Add("email@oculto.com.br");

            objEmail.Priority = MailPriority.Normal;
            // identifica se o conteúdo do e-mail é HTML ou texto simples
            objEmail.IsBodyHtml = true;
            // assunto do e-mail
            objEmail.Subject = "Cadastro Anuncio";
            // corpo do e-mail
            objEmail.Body = message;

            //Para evitar problemas de caracteres "estranhos", configuramos o charset para "ISO-8859-1" 
            objEmail.SubjectEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");
            objEmail.BodyEncoding = System.Text.Encoding.GetEncoding("ISO-8859-1");

            // cria o objeto que envia de fato o e-mail
            SmtpClient objSmtp = new SmtpClient();
            objSmtp.Host = "smtp.guiadefestascuritiba.com.br";
            objSmtp.Port = 587;

            //objSmtp.DeliveryMethod = SmtpDeliveryMethod.Network;
            objSmtp.Credentials = new System.Net.NetworkCredential("cadastro@guiadefestascuritiba.com.br", "cadastro@2013");
            //objSmtp.UseDefaultCredentials = true;

            try
            {
                objSmtp.Send(objEmail);
                ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Contato enviado com sucesso!'); </script>", false);

            }
            catch (Exception ex)
            {
                ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('" + ex.Message + "'); </script>", false);
            }
        }
        else
        {
            ScriptManager.RegisterStartupScript(Page, Page.GetType(), "clientscript", "<script language='JavaScript'>alert('Você deve aceitar os termos para prosseguir !'); </script>", false);
        }

    }

    protected void btnLimpar_Click(object sender, EventArgs e)
    {

    }
}