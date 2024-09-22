const autoDisappear = document.querySelector('.autodis3s');
    const closeSignals = document.querySelectorAll('.act-close');
    const btn = document.querySelector('.open-noti');
    notis = document.querySelectorAll('.noti');
    // notis.forEach(noti => {
    //     btn.onclick = function(){
    //         noti.classList.remove('hide');
    //     };
    // });
    // btn.onclick = function(){
    //     const noti = document.querySelector('.noti');
    //     noti.classList.remove('hide');
    // };
    
    closeSignals.forEach((e) =>{e.onclick = function(){
        e.closest('.noti').classList.add('hide');
    }});
    const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                let classList = alert.className.split(' ');
                classList.forEach(className => {
                    if (className.startsWith('autodis')) {
                        let timeInSeconds = parseInt(className.replace('autodis', '').replace('s', ''), 10);
                        // Ẩn alert sau khoảng thời gian xác định
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, timeInSeconds * 1000);
                    }
                });
            });
    