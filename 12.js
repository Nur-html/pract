// --- 1. Логика открытия формы добавления фото ---
const showBtn = document.querySelector("#show_add_photo");
const addNewPhotoBlock = document.querySelector("#add_new_photo");

if (showBtn && addNewPhotoBlock) {
    showBtn.addEventListener("click", function (e) {
        e.preventDefault();
        addNewPhotoBlock.classList.add("open");
    });
}

// --- 2. Логика кнопки Отмена ---
const cancelBtn = document.querySelector("#cancel");
if (cancelBtn && addNewPhotoBlock) {
    cancelBtn.addEventListener("click", function (e) {
        e.preventDefault();
        addNewPhotoBlock.classList.remove("open");
        
        const inputSrc = document.querySelector("#new_photo_src");
        const inputText = document.querySelector("#new_photo_text");
        const errorMessage = document.querySelector("#form_error_message");

        if (inputSrc) { inputSrc.value = ""; inputSrc.style.border = ""; }
        if (inputText) { inputText.value = ""; inputText.style.border = ""; }
        if (errorMessage) { errorMessage.innerText = ""; errorMessage.style.display = "none"; }
    });
}

// --- 3. Проверка полей на пустоту (Кастомный вывод ошибки) ---
const photoForm = document.querySelector("#photo_form");
if (photoForm) {
    photoForm.addEventListener("submit", function (e) {
        const inputSrc = document.querySelector("#new_photo_src");
        const inputText = document.querySelector("#new_photo_text");
        const errorMessage = document.querySelector("#form_error_message");
        let hasError = false;

        // Сбрасываем старые рамки и скрываем прошлую ошибку
        if (inputSrc) inputSrc.style.border = "";
        if (inputText) inputText.style.border = "";
        if (errorMessage) {
            errorMessage.innerText = "";
            errorMessage.style.display = "none";
        }

        // Проверяем ячейку ссылки на картинку
        if (inputSrc && inputSrc.value.trim() === "") {
            inputSrc.style.border = "2px solid #ff4a4a"; // Красная рамка для ячейки
            hasError = true;
        }

        // Проверяем ячейку подписи
        if (inputText && inputText.value.trim() === "") {
            inputText.style.border = "2px solid #ff4a4a"; // Красная рамка для ячейки
            hasError = true;
        }

        // Если нашли хотя бы одно пустое поле
        if (hasError) {
            e.preventDefault(); // ЖЕСТКО блокируем отправку формы и перезагрузку
            
            if (errorMessage) {
                errorMessage.innerText = "Поля не должны быть пустыми!"; // Пишем твой текст
                errorMessage.style.display = "block"; // Показываем его внутри окна
            }
        }
    });

    // Убираем красную рамку с ячейки, когда пользователь начинает вводить текст
    photoForm.querySelectorAll("input").forEach(input => {
        input.addEventListener("input", function() {
            if (this.value.trim() !== "") {
                this.style.border = "";
            }
        });
    });
}

// --- 4. Просмотр полноразмерного фото в поп-апе ---
const popupPhoto = document.querySelector("#popup_photo");

function open_photo(e) {
    if (popupPhoto) {
        e.preventDefault();
        const clickedImg = this.querySelector("img");
        const popupImg = popupPhoto.querySelector("img");
        
        if (clickedImg && popupImg) {
            popupImg.src = clickedImg.src;
            popupPhoto.classList.add("open");
        }
    }
}

document.querySelectorAll(".photo").forEach(photo => {
    photo.addEventListener("click", open_photo);
});

if (popupPhoto) {
    popupPhoto.addEventListener("click", function () {
        this.classList.remove("open");
    });
}