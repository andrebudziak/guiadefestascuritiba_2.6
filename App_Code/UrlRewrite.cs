using System;
using System.Collections.Generic;
using System.Linq;
using System.Xml.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Web;

public class UrlRewrite
{
    public void escreveUrl()
    {
        try
        {
            HttpRequest Request = HttpContext.Current.Request;

            XElement objXElement = XElement.Load(Request.PhysicalApplicationPath + "xml\\UrlRewrite.xml");

            if (objXElement.HasElements)
            {
                var xml = from rule in objXElement.Descendants("rule")
                          select rule;

                if (xml.Count<XElement>() > 0)
                {
                    Dictionary<Regex, string> urlRewrite = new Dictionary<Regex, string>();

                    foreach (XElement element in xml)
                    {
                        urlRewrite.Add(new Regex(Request.ApplicationPath + element.Element("url").Value, RegexOptions.IgnoreCase),
                                       Request.ApplicationPath + element.Element("rewrite").Value);
                    }

                    foreach (KeyValuePair<Regex, string> url in urlRewrite)
                    {
                         if (url.Key.Match(HttpContext.Current.Request.Path).Success)
                            HttpContext.Current.RewritePath(url.Key.Replace(HttpContext.Current.Request.Path, url.Value));
                    }
                }
            }
        }
        catch (Exception ex)
        {
            throw ex;
        }
    }


    public String RemoveSpecialCharacters(String self)
    {
        var normalizedString = self;

        // Prepara a tabela de símbolos.
        var symbolTable = new Dictionary<char, char[]>();
        symbolTable.Add('a', new char[] { 'à', 'á', 'ä', 'â', 'ã' });
        symbolTable.Add('c', new char[] { 'ç' });
        symbolTable.Add('e', new char[] { 'è', 'é', 'ë', 'ê' });
        symbolTable.Add('i', new char[] { 'ì', 'í', 'ï', 'î' });
        symbolTable.Add('o', new char[] { 'ò', 'ó', 'ö', 'ô', 'õ' });
        symbolTable.Add('u', new char[] { 'ù', 'ú', 'ü', 'û' });

        // Substitui os símbolos.
        foreach (var key in symbolTable.Keys)
        {
            foreach (var symbol in symbolTable[key])
            {
                normalizedString = normalizedString.Replace(symbol, key);
            }
        }

        // Remove os outros caracteres especiais.
        normalizedString = Regex.Replace(normalizedString, "[^0-9a-zA-Z._]+?", "-");
        return normalizedString;
    }


}
