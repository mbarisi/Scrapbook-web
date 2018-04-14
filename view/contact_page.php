<?php require_once 'view/_header.php'; ?>

  <p id="contact_mismo">Mi smo Iva, Martina i Tena, <br> catch us if you can. :) </p><br>

<div id="contact_form" >
  <div class="cleaner_h10"></div>
  <br>
      <div class="cleaner_h10"></div>
      <form method="post" name="contact" action="index.php?rt=page/mail">
        <label for="author">Name:</label>
        <input type="text" id="author" class="input_field" name="author" />
        <div class="cleaner_h10"></div>

        <label for="email">Email:</label>
        <input type="text"  id="email" class="input_field" name="email" />
        <div class="cleaner_h10"></div>

        <label for="subject">Subject:</label>
        <input type="text"  id="subject" class="input_field" name="subject" />
        <div class="cleaner_h10"></div>

        <label for="text">Message:</label>
        <textarea id="text" name="text" rows="0" cols="0" class="message_field"></textarea>
        <div class="cleaner_h10"></div>

        <button type="submit" id="forma_submit_btn" > Pošalji </button>
        <button type="reset" id="forma_reset_btn" > Resetiraj </button>
      </form>
 </div>


  <div class="col_380 float_r"> </div>


<?php require_once 'view/_footer.php'; ?>
