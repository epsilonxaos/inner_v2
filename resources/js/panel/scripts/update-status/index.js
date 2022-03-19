window.cambiarStatusGeneral = function(el, id, status, url){
    // let url = document.querySelector('label.'+el).dataset.url;
    axios.post(url, {
        id: id,
        status: status
    })
    .then(function (response) {
        document.querySelector('label.'+el).removeAttribute('onclick');
        console.log('label.'+el);
        let n = status === 1 ? 0 : 1;
        console.log(n);
        document.querySelector('label.'+el).setAttribute('onclick', `cambiarStatusGeneral('${el}+', ${id}, ${n}, '${url}')`);
        alertify.notify('Hecho!', 'success', 2);
    })
    .catch(function (error) {
        console.log(error);
    });
}
