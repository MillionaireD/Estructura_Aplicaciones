/*!
* Start Bootstrap - Simple Sidebar v6.0.6
*/

// ================== Sidebar collapse ==================
document.querySelectorAll('#sidebar-wrapper a[data-bs-toggle="collapse"]').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        const target = document.querySelector(link.getAttribute('href'));
        if(target.classList.contains('show')) {
            target.classList.remove('show'); // cerrar si ya estaba abierto
        } else {
            target.classList.add('show'); // abrir si estaba cerrado
        }
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

// Botones lista enlazada
document.getElementById('insertBtn').addEventListener('click', () => {
    const val = document.getElementById('listData').value.trim();
    if (val) list.insert(val);
    renderList();
});

document.getElementById('deleteBtn').addEventListener('click', () => {
    const val = document.getElementById('listData').value.trim();
    if (val) list.delete(val);
    renderList();
});

document.getElementById('traverseBtn').addEventListener('click', renderList);

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

// Botón validar
document.getElementById('validateBtn').addEventListener('click', () => {
    const exp = document.getElementById('expression').value.trim();
    const result = exp ? (areParenthesesBalanced(exp) ? 'Balanceado ✅' : 'No balanceado ❌') : 'Ingresa una expresión';
    document.getElementById('validationResult').textContent = exp + ' -> ' + result;
});

