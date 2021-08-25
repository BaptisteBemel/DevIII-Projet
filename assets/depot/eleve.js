import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'
import * as ReactBootStrap from "react-bootstrap"

function gid(id) {
    return document.getElementById(id);
}
//Travail commencé pour la réception des données mais du coup us 13 et pas 12
class DepotEleve extends Component {
    constructor(props) {
        super(props)

        this.state = {
            emailAddress: "",
            title: "",
            description: "",
            ClosingDate: "",
            isOpen: false
        }
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/api/depot', this.state)
            .then(response => {
                this.renderTable(response.data)
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderTable(données) {
        données = données.map(champ => 
           champ = {dateRdv : champ.dateRdv.substring(8,10) + '/' + champ.dateRdv.substring(5,7) + ' ' + champ.dateRdv.substring(11,16), jour : champ.dateRdv.substring(8,10), mois : champ.dateRdv.substring(5,7), heure : champ.dateRdv.substring(11,16), annee : champ.dateRdv.substring(0,4), idDate: champ.dateRdv.substring(0,16)}
        ).sort((a, b) => new Date(...a.dateRdv.split('/').reverse()) - new Date(...b.dateRdv.split('/').reverse()))
        document.getElementById('trAffichage').innerHTML = données.map(champ => {
            return (
                '<tr><td><input type="radio" id="' + champ.idDate.substring(0,16) + '" class="date" name="date" value="' + champ.dateRdv + '"> ' + champ.dateRdv + '</td></tr>'
            )
        }).join('')
    }

    render() {
        return (
            <div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">A finir pour le</th>
                            <th scope="col">Fichier</th>
                        </tr>
                    </thead>
                    <tbody id="table-donnee">
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>file</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        )
    } 
}

export default DepotEleve;