class Book {
    constructor(title, author, maxPages, onPage) {
      this.title = title;
      this.author = author;
      this.maxPages = maxPages;
      this.onPage = onPage;
    }
  }
  
  class UI {
    static displayBooks() {
      const books = Store.getBooks();
  
      books.forEach((book) => UI.addBookToList(book));
    }
  
    static addBookToList(book) {
      const list = document.querySelector('#book-list');

      const readList = document.querySelector('#read-list');
  
      const row = document.createElement('tr');

      const li = document.createElement('li');

      li.classList.add('list-group-item');

      const prog = (book.onPage / book.maxPages) * 100;
  
      row.innerHTML = `
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.maxPages}</td>
        <td>${book.onPage}</td>
        <td><div class="myProgress"><div style="width: ${prog}%" class="myBar">${prog}%</div></div></td>
        <td><a href="#" class="btn btn-danger btn-sm delete">X</a></td>
      `;

      if(book.onPage == book.maxPages) {
        li.classList.add('text-success');
        li.innerText = `You already read "${book.title}" by ${book.author}`;
      } else {
        li.classList.add('text-danger');
        li.innerText = `You still haven't read "${book.title}" by ${book.author}`;
      }
      

      readList.appendChild(li);
  
      list.appendChild(row);
    }
  
    static deleteBook(el) {
      if(el.classList.contains('delete')) {
        el.parentElement.parentElement.remove();
      }
    }
  
    static showAlert(message, className) {
      const div = document.createElement('div');
      div.className = `alert alert-${className}`;
      div.appendChild(document.createTextNode(message));
      const container = document.querySelector('.container');
      const form = document.querySelector('#book-form');
      container.insertBefore(div, form);
  
      setTimeout(() => document.querySelector('.alert').remove(), 3000);
    }
  
    static clearFields() {
      document.querySelector('#title').value = '';
      document.querySelector('#author').value = '';
      document.querySelector('#maxPages').value = '';
      document.querySelector('#onPage').value = '';
    }
  }
  
  class Store {
    static getBooks() {
      let books;
      if(localStorage.getItem('books') === null) {
        books = [];
      } else {
        books = JSON.parse(localStorage.getItem('books'));
      }
  
      return books;
    }
  
    static addBook(book) {
      const books = Store.getBooks();
      books.push(book);
      localStorage.setItem('books', JSON.stringify(books));
    }
  
    static removeBook(title) {
      const books = Store.getBooks();
  
      books.forEach((book, index) => {
        if(book.title === title) {
          books.splice(index, 1);
        }
      });
  
      localStorage.setItem('books', JSON.stringify(books));
    }
  }
  
  document.addEventListener('DOMContentLoaded', UI.displayBooks);
  
  document.querySelector('#book-form').addEventListener('submit', (e) => {

    e.preventDefault();
  
    const title = document.querySelector('#title').value;
    const author = document.querySelector('#author').value;
    const maxPages = document.querySelector('#maxPages').value;
    const onPage = document.querySelector('#onPage').value;
  
    if(title === '' || author === '' || maxPages === '' || onPage === '') {
      UI.showAlert('Please fill in all fields', 'danger');
    } else {
      const book = new Book(title, author, maxPages, onPage);
  
      UI.addBookToList(book);
  
      Store.addBook(book);
  
      UI.showAlert('Book Added', 'success');
  
      UI.clearFields();
    }
  });
  
  document.querySelector('#book-list').addEventListener('click', (e) => {
    
    UI.deleteBook(e.target);
  
    Store.removeBook(e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent);  
    
    UI.showAlert('Book Removed', 'success');
  });