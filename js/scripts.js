/*!
* Start Bootstrap - Simple Sidebar v6.0.6
*/

// ================== Sidebar collapse ==================
document.addEventListener("DOMContentLoaded", function(){
    
    // Sidebar toggle principal
    const sidebarToggle = document.getElementById("sidebarToggle");
    if(sidebarToggle){
        sidebarToggle.addEventListener("click", function(e){
            e.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
        });
    }

    // Submenús del sidebar usando Bootstrap Collapse
    document.querySelectorAll('#sidebar-wrapper [data-bs-toggle="collapse"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            // Bootstrap manejará automáticamente el colapso
        });
    });

});

// ================== LISTA ENLAZADA ==================
class Node {
    constructor(data) {
        this.data = data;
        this.next = null;
    }
}

class LinkedList {
    constructor() {
        this.head = null;
    }

    insert(data) {
        const newNode = new Node(data);
        if (!this.head) this.head = newNode;
        else {
            let temp = this.head;
            while (temp.next) temp = temp.next;
            temp.next = newNode;
        }
    }

    delete(data) {
        if (!this.head) return false;
        if (this.head.data === data) {
            this.head = this.head.next;
            return true;
        }
        let temp = this.head;
        while (temp.next && temp.next.data !== data) temp = temp.next;
        if (temp.next) {
            temp.next = temp.next.next;
            return true;
        }
        return false;
    }

    traverse() {
        const elements = [];
        let temp = this.head;
        while (temp) {
            elements.push(temp.data);
            temp = temp.next;
        }
        return elements;
    }
}

// Inicializamos lista y referencias
const list = new LinkedList();
const listContainer = document.getElementById('listContainer');

// Actualizar visualización
function renderList() {
    if (!listContainer) return;
    
    listContainer.innerHTML = '';
    const elements = list.traverse();
    if (elements.length === 0) {
        listContainer.innerHTML = '<span>Lista vacía</span>';
    } else {
        elements.forEach(el => {
            const div = document.createElement('div');
            div.textContent = el;
            div.style.cssText = 'padding:5px 10px; background:#555; color:white; border-radius:5px;';
            listContainer.appendChild(div);
        });
    }
}

// Botones lista enlazada (solo si existen)
document.addEventListener('DOMContentLoaded', function() {
    const insertBtn = document.getElementById('insertBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const traverseBtn = document.getElementById('traverseBtn');
    
    if (insertBtn) {
        insertBtn.addEventListener('click', () => {
            const val = document.getElementById('listData').value.trim();
            if (val) list.insert(val);
            renderList();
        });
    }
    
    if (deleteBtn) {
        deleteBtn.addEventListener('click', () => {
            const val = document.getElementById('listData').value.trim();
            if (val) list.delete(val);
            renderList();
        });
    }
    
    if (traverseBtn) {
        traverseBtn.addEventListener('click', renderList);
    }
});

// ================== VALIDACIÓN DE PARÉNTESIS ==================
function areParenthesesBalanced(expr) {
    const stack = [];
    const pairs = {')':'(', ']':'[', '}':'{'};
    for (let c of expr) {
        if (['(', '[', '{'].includes(c)) stack.push(c);
        else if ([')', ']', '}'].includes(c)) {
            if (!stack.length || stack.pop() !== pairs[c]) return false;
        }
    }
    return stack.length === 0;
}

// Botón validar (solo si existe)
document.addEventListener('DOMContentLoaded', function() {
    const validateBtn = document.getElementById('validateBtn');
    if (validateBtn) {
        validateBtn.addEventListener('click', () => {
            const exp = document.getElementById('expression').value.trim();
            const result = exp ? (areParenthesesBalanced(exp) ? 'Balanceado ✅' : 'No balanceado ❌') : 'Ingresa una expresión';
            document.getElementById('validationResult').textContent = exp + ' -> ' + result;
        });
    }
});