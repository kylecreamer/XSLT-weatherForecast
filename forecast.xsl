<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <title>Local Forecast</title>
                <style>
                    table, tr, td {
                    border: 1px solid black;
                    vertical-align:top;
                    }
                    .header{
                    font-style: italic;
                    }
                    body{
                    font-family:Verdana, Sans-serif;
                    line-height: .5;
                    }
                    #tableContainer{
                    max-width:84.5%;
                    }
                </style>
            </head>
            <body>
                <xsl:for-each select="forecast/location">
                <h1>Forecast for <xsl:value-of select="city"/>, <xsl:value-of select="province"/>, <xsl:value-of select="country"/> </h1>
                    <p class="header">Issued at <xsl:value-of select="issued"/></p>
                    <h2>Five Day Forecast</h2>
                    <p class="header">Degrees in <xsl:value-of select="degrees"/></p>
                </xsl:for-each>
                <div id="tableContainer">
                    <table>
                        <tr>
                            <xsl:for-each select ="forecast/daily/day">
                                <td>
                                   <p><xsl:value-of select = "date"/></p>
                                    <br></br>
                                    <xsl:choose>
                                        <xsl:when test = "condition = 'sun-cloud'">
                                            <img src="images/sun-cloud.jpg"> </img>
                                        </xsl:when>

                                        <xsl:when test = "condition = 'rain'">
                                            <img src="images/rain.jpg"> </img>
                                        </xsl:when>
                                        <xsl:when test = "condition = 'overcast'">
                                            <img src="images/overcast.jpg"> </img>
                                        </xsl:when>
                                        <xsl:when test = "condition = 'snow'">
                                            <img src="images/snow.jpg"> </img>
                                        </xsl:when>
                                        <xsl:when test = "condition = 'sun'">
                                            <img src="images/sun.jpg"> </img>
                                        </xsl:when>
                                        <xsl:when test = "condition = 'lightning'">
                                            <img src="images/lightning.jpg"> </img>
                                        </xsl:when>
                                        <xsl:otherwise>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                    <p>High: <xsl:value-of select = "high"/>&#176; <br></br> Low: <xsl:value-of select = "low"/>&#176;</p>
                                    <hr></hr>
                                    <p><xsl:value-of select="description"/></p>
                                </td>
                            </xsl:for-each>
                        </tr>
                     </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>