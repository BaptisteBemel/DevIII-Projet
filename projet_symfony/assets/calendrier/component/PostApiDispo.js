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
        axios.post('/api/dispo/post', this.state)
            .then(response => {
                let data = new Array();
                data.push(this.state)
            })
            .catch(error => {
                null
            })
    }
    
    render() {
        const { date_rdv } = this.state
        return (
            <div>
                <input type="datetime-local" name="date_rdv" value={date_rdv} onChange={this.changeHandler} />
                <button onClick={this.submitHandler}>Ajouter des disponibilites</button>
                <div id="msgErr"></div>
            </div>
        )
    }
}
export default PostApiDispo;