<?php require_once 'view/_header.php'; ?>


  <div id="osobe">
    <p> Nacrtajte nešto na desnoj stranici. </p>


    <p>
     <label id="dtool" style="visibility: hidden">Drawing tool:<select>
        <option value="pencil">Pencil</option>
      </select>
    </label>
    </p>
  </div>
   <div id="container">
      <canvas id="imageView" width="460" height="730"></canvas>
   </div>

    <a id="download">Preuzmite svoj crtež kao sliku.</a>

    <script type="text/javascript" src="view/canvas.js"> </script>





  <?php require_once 'view/_footer.php';  ?>
