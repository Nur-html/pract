<div id="add_new_photo">
    <form action="new_photo.php" method="post" id="photo_form">
        
        <div id="form_error_message" style="color: #ff4a4a; font-weight: bold; text-align: center; margin-bottom: 15px; display: none;"></div>
        
        <input id="new_photo_src" type="text" placeholder="Картинка" name="image" autocomplete="off">
        <input id="new_photo_text" type="text" placeholder="Подпись" name="text" autocomplete="off">
        
        <button id="add_photo" type="submit">Добавить</button> 
        <button id="cancel" type="button">Отмена</button>
    </form>
</div>