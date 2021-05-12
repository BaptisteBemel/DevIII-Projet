import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'

function affichage(données){
    données.forEach(x => {
        document.getElementById('trAffichage').innerHTML += '<td>x.dateRdv</td>'
    })
}

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
    } //console.log(response.data) affichage(response.data)

    
    render() {
        return (
            <div>
                <div>
                    <button onClick={this.submitHandler}>Afficher des disponibilites</button>
                </div>
            </div>
        )
    }
}
export default GetApiDispo;

/*
<div>
                    <table>
                        <thead>
                            <tr id="trAffichage">
                                <th>Plages horaire disponibles</th>
                            </tr>
                        </thead>
                    </table>
                </div>*/