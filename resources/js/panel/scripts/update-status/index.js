window.cambiar_status = function(el, id, status){
    let url = document.querySelector('label.'+el).dataset.url;
    axios.post(url, {
        id: id,
        status: status
    })
    .then(function (response) {
        console.log(response);
        document.querySelector('label.'+el).removeAttribute('onclick');
        let n = status === 'visible' ? 'hide' : 'visible';
        console.log(n);
        document.querySelector('label.'+el).setAttribute('onclick', 'cambiar_status(\''+el+'\', '+id+', \''+n+'\')');
        alertify.notify('Hecho!', 'success', 2);
    })
    .catch(function (error) {
        console.log(error);
    });
}
