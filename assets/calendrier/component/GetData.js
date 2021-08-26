import React, { Component } from 'react';
import axios from 'axios';
import { render } from 'react-dom';
import "../utils";
import * as ReactBootStrap from "react-bootstrap"

class GetData extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre',
            matiere: ''
        }
    }


    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/reservations', this.state)
            .then(response => {
                this.renderTable(response.data)
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderTable(données) {
        let table = document.getElementById("trAffichageUser");
        for(let donnee of données) {
            table.innerHTML += "<tr><td class='bg-white'>" + donnee["dateRdv"] + "</td><td class='bg-white'>" + donnee["matiere"] + "</td><td class='bg-white'>" + donnee["id"]["prenom"] + ' ' + donnee["id"]["nom"] + "</td></tr>"
        }
    }

    
    render() {
        return (
            <div>
                <div>
                <h3 style={{fontFamily: 'rockwell', fontSize: '150%', marginBottom: '1%', marginTop: "5%"}}>Plages horaires réservées : </h3>
                    <table className="table">
                        <thead className="thead-dark">
                            <tr>
                                <th scope="col">Heure</th>
                                <th scope="col">Matiere</th>
                                <th scope="col">Elève</th>
                            </tr>
                        </thead>
                        <tbody id='trAffichageUser'>
                        </tbody>
                    </table>
                    <div id="msg"></div>
                    <div id="messageErreur"></div>
                </div>
            </div>
        )
    }
}
export default GetData;