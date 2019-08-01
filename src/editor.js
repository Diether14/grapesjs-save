import axios from 'axios';
window.Pages = {
    indexLoad: () => {
        axios.get('http://localhost/grapesjs-save/api/pages/index.php')
        .then( (result) => {
            result.data.forEach(element => {
                window.Pages.indexAddColumn(element.name, element.id, -1);
            });
        })
    },
    deletePage : (id) => {
        if(confirm('Delete Contact #'+id)){
            axios.delete('http://localhost/grapesjs-save/api/pages/delete.php',{ params: {
                id: id
            }})
            .then((result)=> {
                if(result.data.success){
                    alert(result.data.message);
                    let row = document.getElementById('tr'+id);
                    row.parentNode.removeChild(row);
                }
            })
        }
    },
    editRedirect: (id) => {
        window.location = 'http://localhost/grapesjs-save/edit.html?id=' + id;
    },
    editLoad: () => {
        let url = new URL(window.location.href);
        let id = url.searchParams.get("id");
        axios.get('http://localhost/grapesjs-save/api/pages/view.php',{
            params: {
                id: id,
            }
        })
        .then((result) => {
            let nameField = document.getElementById('name');
            nameField.value = result.data.name;
            let pagePreview = document.getElementById('page_preview');
            pagePreview.innerHTML = result.data.html;
        })
    },
    indexAddColumn: (name, id, place) => {
        let table = document.getElementById('index_table');
        let newRow = table.insertRow(place);
        newRow.setAttribute('id', 'tr'+id);
        
        let idCell = newRow.insertCell(-1);
        let nameCell = newRow.insertCell(-1);
        let btnCell = newRow.insertCell(-1);

        let nameText = document.createTextNode(name);
        let idText = document.createTextNode(id);

        let previewBtn = document.createElement("button");
        previewBtn.setAttribute('class', 'btn btn-sm btn-primary');
        previewBtn.setAttribute('onClick', 'window.Pages.savePage()');
        previewBtn.innerHTML = 'Preview';
        
        let editBtn = document.createElement("button");
        editBtn.setAttribute('class', 'btn btn-sm btn-success mx-2');
        editBtn.setAttribute('onClick', 'window.Pages.editRedirect('+id+')');
        editBtn.innerHTML = 'Edit';
        
        let delBtn = document.createElement("button");

        delBtn.setAttribute('class', 'btn btn-sm btn-danger');
        delBtn.setAttribute('onClick', 'window.Pages.deletePage('+id+')');
        delBtn.innerHTML = 'Delete';

        idCell.appendChild(idText);
        nameCell.appendChild(nameText);
        btnCell.appendChild(previewBtn);
        btnCell.appendChild(editBtn);
        btnCell.appendChild(delBtn);
    },
    indexSave: () => {
        let html = '<p>Start editing your page here</p>';
        let textField = document.getElementById('name');
        let name = textField.value;
        let data = new FormData;
        data.append('name', name);
        data.append('html',html);
        axios.post('http://localhost/grapesjs-save/api/pages/create.php',data)
        .then((response) => {
            alert('Page Added');
            window.Pages.indexAddColumn(response.data.name, response.data.id, 1);
        })
    },
    editSave: () => {
        let url = new URL(window.location.href);
        let id = url.searchParams.get("id");
        let textField = document.getElementById('name');
        let name = textField.value;
        let data = new FormData;
        data.append('name', name);
        data.append('id',id);
        axios.post('http://localhost/grapesjs-save/api/pages/updateMeta.php',data)
        .then((response) => {
            console.log(response.data);
        })
    },
    editorRedirect: () => {
        let url = new URL(window.location.href);
        let id = url.searchParams.get("id");
        window.location = 'http://localhost/grapesjs-save/editor.html?id=' + id;
    },
    editorLoad: () => {
        let url = new URL(window.location.href);
        let id = url.searchParams.get("id");
        axios.get('http://localhost/grapesjs-save/api/pages/view.php',{
            params: {
                id: id,
            }
        })
        .then((result) => {
            window.editor.setComponents(result.data.html);
        })
    }
}