async function add()
{
    let num = 1;
    const text = $('#add-text').val();

    $('#empty').css('display', 'none');
    showLoader(1)

    if($('.table>tbody>tr:last-child').text()){
        num = parseInt($('.table>tbody>tr:last-child').text()) + 1;
    }

    if ($('#add-text').val() != ''){
        showAddError(0)

        html = '<tr data-q="'+num+'"><th scope="row">'+num+'</th><td style="word-wrap: break-word, min-width:2rem; max-width:30rem;">'+$('#add-text').val()+'</td><td class="text-right"><button onclick="done('+num+')" class="btn btn-success mr-4">done</button><button onclick="remove('+num+')" class="btn btn-danger remove-btn-hide">remove</button></td></tr>';
        $('tbody').append(html);

        const res = await sendMessage({
            text: text,
            num: num,
        }, '/newtodo');

        console.log(res);

        if (res == true){
            showLoader(0)
        } else {
            showAddError(1)
        }
    } else {
        showAddError(1)
        showLoader(0)
    }
}

function done(index)
{
    const tr = $('tr[data-q="'+index+'"]>td');

    if (!tr.hasClass('done')){
        tr.eq(0).addClass('done');

        $('tr[data-q="'+index+'"]').children('td.text-right').children('.btn-success').remove();
        $('tr[data-q="'+index+'"]').children('td.text-right').children('.remove-btn-hide').removeClass('remove-btn-hide');

        sendMessage({
            num: index,

        },'/done');
    }
}

function remove(index)
{
    $('tr[data-q="'+index+'"]').remove();

    if (document.querySelector('.table-body').childElementCount == 0){
        $('#empty').css('display', 'inline');
    }

    sendMessage({
        num: index
    }, '/remove-todo');
}

async function sendMessage(data, url)
{
    let res = false;

    await axios({
        method: 'post',
        url: url,
        data: data
    }).then(response => {res = response.data.success; console.log(response);});

    return res;
}

function showAddError(status)
{
    if (status === 0){
        $('.error').css('display', 'none');
    } else if (status === 1) {
        $('.error').css('display', 'inline');
    }
}

function showLoader(status)
{
    if (status === 0){
        $('.loader').css('display', 'none');
        $('.btn-text').css('display', 'inline');
        $('.add-btn').removeAttr('disabled');
    } else if (status === 1){
        $('.add-btn').attr('disabled', true);
        $('.btn-text').css('display', 'none');
        $('.loader').css('display', 'inline');
    }
}
