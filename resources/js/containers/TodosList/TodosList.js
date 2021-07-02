import React, {Component} from 'react';
import './TodosList.css';
import 'axios';
import AddTodoForm from '../../components/AddTodoForm/AddTodoForm';
import TodoList from '../../components/TodoList/TodoList';

class TodosList extends Component{
    constructor(){
        super();
        this.state = {
            todos: [],
            todo: {
                title: ''
            }
        }
        this.todoTitleChangedHandler = this.todoTitleChangedHandler.bind(this);
        this.addTodoHandler = this.addTodoHandler.bind(this);
        this.todoUpdateHandler = this.todoUpdateHandler.bind(this);
        this.deleteTodoHandler = this.deleteTodoHandler.bind(this);
    }

    componentDidMount(){
        axios.get('/api/todos')
        .then(response => {
            this.setState({
                todos: response.data.todoList
            });
        });
    }

    todoTitleChangedHandler(event){
        this.setState({
            todo: {
                title: event.target.value
            }
        });
    }

    //Handler for todo addition.
    addTodoHandler(event){
        event.preventDefault();
        let params = {title: this.state.todo.title, done: 0}
        axios.post('/api/todo/add/', params).then(response => {
            axios.get('/api/todos')
            .then(response => {
                this.setState({
                    todos: response.data.todoList,
                    todo: { title: '' }
                });
            });
        });
    }

    //Handler for todo Update
    todoUpdateHandler(event){
        let id = event.currentTarget.getAttribute('id');
        let url = '/api/todo/update/' + id;
        axios.post(url).then(response => {
            axios.get('/api/todos')
            .then(response => {
                this.setState({
                    todos: response.data.todoList
                });
            });
        }).catch(error => { console.log(error) });
    }

    //Handler for todo Deletion
    deleteTodoHandler(event){
        let id = event.currentTarget.getAttribute('id');
        let url = '/api/todo/delete/' + id;
        axios.post(url).then(response => {
            axios.get('/api/todos')
            .then(response => {
                this.setState({
                    todos: response.data.todoList
                });
            });
        }).catch(error => { console.log(error) });
    }
    
    render(){
        return( 
            <div className="wrapper">
                <AddTodoForm changed={this.todoTitleChangedHandler} submitted={this.addTodoHandler} title={this.state.todo.title} />     
                <TodoList todos={this.state.todos} marker={this.todoUpdateHandler} delete={this.deleteTodoHandler} />
            </div>
        ); 
    }
}

export default TodosList;