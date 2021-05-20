import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'


function affichage(données){
    document.getElementById('titre').innerHTML = '<th>Plages horaire disponibles</th>';
    document.getElementById('tbAffichage').innerHTML = '';
    données.forEach(x => {
        document.getElementById('tbAffichage').innerHTML += '<tr>'+ x.dateRdv.substring(0,16) + '</tr>'
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
                affichage(response.data)
            })
    }

    
    render() {
        return (
            <div>
                <div>
                    <button onClick={this.submitHandler}>Afficher des disponibilites</button>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr id='titre'>
                            </tr>
                        </thead>
                        <tbody id='tbAffichage'>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        )
    }
}
export default GetApiDispo;