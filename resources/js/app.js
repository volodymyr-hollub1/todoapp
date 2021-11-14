require('./bootstrap');

window.Echo.channel ("todoapp")
    .listen('.todo', function(e){
        if (e.action === 'done')
        {
            document.querySelector('tr[data-q="'+e.num+'"]>td').classList.add('done');
            document.querySelector('tr[data-q="'+e.num+'"]').querySelector('td.text-right>.btn-success').remove();
            document.querySelector('tr[data-q="'+e.num+'"]').querySelector('td.text-right>.remove-btn-hide').classList.remove('remove-btn-hide');
        }

        if (e.action === 'create')
        {
            const element = '<tr data-q="'+e.num+'"><th scope="row">'+e.num+'</th><td style="word-wrap: break-word, min-width:2rem; max-width:30rem;">'+e.text+'</td><td class="text-right"><button onclick="done('+e.num+')" class="btn btn-success mr-4">done</button><button onclick="remove('+e.num+')" class="btn remove-btn-hide btn-danger">remove</button></td></tr>';

            document.querySelector('tbody').insertAdjacentHTML('beforeend', element);
        }

        if (e.action === 'removeTodo')
        {
            if(document.querySelector('.table-body').childElementCount == 0){
                document.querySelector('#empty').style.display = 'inline';
            }else{
                document.querySelector('tr[data-q="'+e.num+'"]').remove();
            }
        }

        console.log(e)
    })
