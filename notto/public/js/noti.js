document.querySelectorAll(".open-noti").forEach(button => {
    button.addEventListener("click", function() {
        const uid = button.getAttribute('uid');

        // Tạo phần tử div chứa thông báo
        const notiDiv = document.createElement("div");
        notiDiv.classList.add("noti", "hide");

        // Nội dung của thông báo
        notiDiv.innerHTML = `
            <div class="close-btn act-close"><i class="fa-solid fa-xmark"></i></div>
            <div class="noti-content">
                You want to delete this user?
            </div>
            <div class="group-bottom-btn">
                <button class="bottom-btn-item act-close cancel">Cancel</button>
                <divide-line></divide-line>
               <form class="bottom-btn-item" action="/delete/${uid}" method="post">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                    <button class="ok">OK</button>
                </form>
            </div>
        `;

        // Thêm phần tử vào thẻ body
        document.body.appendChild(notiDiv);
        window.addEventListener('click', function(event) {
            if (event.target === notiDiv) {
                notiDiv.classList.add('hide');
            }
        });

        // Hiển thị thông báo (bỏ class 'hide' nếu cần)
        notiDiv.classList.remove('hide');

        // Xử lý sự kiện đóng thông báo
        const closeButtons = notiDiv.querySelectorAll('.act-close');
        closeButtons.forEach(closeBtn => {
            closeBtn.addEventListener("click", function() {
                notiDiv.remove(); // Xóa phần tử khi nhấn vào nút đóng
            });
        });
    });
});
