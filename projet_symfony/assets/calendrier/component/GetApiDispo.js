import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'

class GetApiDispo extends Component {
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
        axios.get('/api/dispo/get', this.state)
            .then(response => {
                console.log(response.data)
            })
    }

    
    render() {
        return (
            <div>
                <button onClick={this.submitHandler}>Afficher des disponibilites</button>
            </div>
        )
    }
}
export default GetApiDispo;