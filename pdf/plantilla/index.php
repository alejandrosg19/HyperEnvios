 <?php
  function getPlantilla($OrdenInfo){
    $plantilla = '<body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
          <h1>Información de orden</h1>
          <div class="date">Fecha de creación: 01/06/2014</div>
        </div>
      </div>
      <table>
        <tbody>
          <tr>
            <th class="tableTH">Fecha Orden</th>
            <td> ' . $OrdenInfo[0][0] . ' </td>
          </tr>
          <tr>
            <th class="tableTH">Fecha Estimación</th>
            <td> ' . $OrdenInfo[0][1] . ' </td>
          </tr>
          <tr>
            <th class="tableTH">Dirección de destino</th>
            <td> ' . $OrdenInfo[0][2] . ' </td>
          </tr>
          <tr>
            <th class="tableTH">Receptor</th>
            <td> ' . $OrdenInfo[0][3] . ' </td>
          </tr>
          <tr>
            <th class="tableTH">Número de contacto</th>
            <td> ' . $OrdenInfo[0][4] . ' </td>
          </tr>
        </tbody>
      </table>';

      for ($i = 0; $i < count($data); $i++) {
            '<div>
                <h3>Estado ' . $data[$i][0] . '</h3>
            </div>
            <div>
                <table class="table" style="width: 80% !important"> 
                    <tbody>
                        <tr>
                            <th> Fecha Estado</th>
                            <td>' . $data[$i][1] . '</td>
                        </tr>
                        <tr>
                            <th> ' . ($data[$i][2] == 1 ? 'Despachador' : 'Conductor') . '</th>
                            <td>' . $data[$i][3] . '</td>
                        </tr>';

                        if($data[$i][2] == 3){
                            $comentarioActor = new ComentarioCliente("","","",$data[$i][4]);
                            $arrayComentario = $comentarioActor -> getInfo();
                            if(count($arrayComentario) == 0){
                                echo "<tr>
                                        <th>Comentarios</th>
                                        <td>No hay comentarios asociados a este estado</td>  
                                    </tr>";
                            }else{
                                echo "
                                    <tr>
                                        <th>Comentarios</th>
                                        <td>";
                                        for ($x = 0; $x < count($arrayComentario); $x++) {
                                            echo "
                                                <table class='table'> 
                                                    <tbody>
                                                        <tr>
                                                            <th> Fecha Comentario</th>
                                                            <td>" . $arrayComentario[$x][0] . "</td>
                                                        </tr>
                                                        <tr>
                                                            <th> Comentario</th>
                                                            <td>" . $arrayComentario[$x][1] . "</td>
                                                        </tr>
                                                    </tbody>
                                                </table>";
                                }
                                echo "</td>  
                                </tr>";
                            }
                        }else{
                            echo "<tr>
                                    <th>Comentarios</th>
                                    <td>No hay comentarios asociados a este estado</td>  
                                </tr>";
                        }   
                        echo "
                    </tbody>
                </table>
            </div>";
        }

      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the companys existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
          </tr>
          <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
          </tr>
          <tr>
            <td class="no">03</td>
            <td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>$1,300.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>$6,500.00</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
    ';

    return $plantilla;
  }
  

?>