import Axios from 'axios';
import { orderBy } from 'lodash';
import Sortable from 'sortablejs';

if(document.getElementById('sortable-items')) {
    var el = document.getElementById('sortable-items');
    var sortable = new Sortable(el, {
        handle: ".drag",
        animation: 150,
        easing: "cubic-bezier(1, 0, 0, 1)",
        // Element dragging ended
        onEnd: function (evt) {
            alertify.alert('Espere un momento porfavor...').set({'frameless': true, 'closable': false, 'movable': false}); 

            var itemEl = evt.item;
            var ordenamiento = [];
            var orden = 0;

            el.querySelectorAll('.sort').forEach(item => {
                ordenamiento.push({id: item.dataset.idx, orden: orden});
                orden++;
            });

            console.log(ordenamiento);
            console.log(el.dataset.url);
            axios.post(el.dataset.url, ordenamiento)
            .then(response => {
                alertify.closeAll();
                alertify.notify('Ordenamiento hecho!', 'success', 2);
            })
            .catch(err => {
                console.error('Error: '+err);
            });
        },
    });
}

if(document.querySelector('.delete-axios')) {
    document.querySelectorAll('.delete-axios').forEach(item => {
        item.addEventListener('click', function(){
            swal({
                title: "¿Finalizar eliminación?",
                icon: "warning",
                buttons: ["Cancelar", "Eliminar"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let idx = this.dataset.idx;
                    alertify.alert('Espere un momento porfavor...').set({'frameless': true, 'closable': false, 'movable': false}); 
                    axios.post(this.dataset.url, {id: idx})
                    .then(response => {
                        document.querySelector('.sort[data-idx="'+idx+'"]').remove();
                        alertify.closeAll();
                        alertify.notify('Eliminado!', 'success', 2);
                    })
                    .catch(err => {
                        console.error('Error: '+err);
                    });
                }
            });
        });
    });
}

if(document.querySelector('.form-submit-alert-wait')) {
    document.querySelector('.form-submit-alert-wait').addEventListener('submit', function(ev){
        ev.preventDefault();
        alertify.alert('Espere un momento porfavor...').set({'frameless': true, 'closable': false, 'movable': false});
        setTimeout(() => {
            this.submit();
        }, 1000);

    });
}