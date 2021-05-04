import React, { Component } from 'react'
import axios from 'axios'

class PostApiDispo extends Component {
    constructor(props) {
        super(props)
    
        this.state = {
             date_rdv: '',
             statut: 'libre'
        }
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        console.log(this.state)
        axios.post('/api/dispo/post', this.state)
        .then(response => {
            console.log(response);
            let data = new Array();
            data.push(this.sate)
        })
        .catch(error => {
            console.log(error)
        })
    }
    
    render() {
        const { date_rdv } = this.state
        return (
            <div>
                <input type="datetime-local" name="date_rdv" value={date_rdv} onChange={this.changeHandler} />
                <button onClick={this.submitHandler}>Ajouter des disponibilites</button>
            </div>
        )
    }
}

export default PostApiDispo