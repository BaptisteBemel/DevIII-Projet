import React, { Component } from 'react';
import axios from 'axios';
import { render } from 'react-dom';
import "../utils";


/*function affichage(données){
    document.getElementById('titre').innerHTML = '<th>Plages horaire disponibles</th>';
    document.getElementById('tbAffichage').innerHTML = '';
    données.forEach(x => {
        document.getElementById('tbAffichage').innerHTML += '<tr><td><input type="checkbox" id="' + 
        x.dateRdv.substring(0,16) + '" name="date" value="date">  '+ x.dateRdv.substring(0,16) + '</td></tr>'
    })
}*/

class GetDispoEleve extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre'
        }
    }

    affichage(données){
        gid('titre').innerHTML = '<th>Plages horaire disponibles</th>';
        gid('tbAffichage').innerHTML = '';
        données.forEach(x => {
            gid('tbAffichage').innerHTML += '<tr><td><input type="radio" id="date" name="date" value="' + x.dateRdv.substring(0,16) + '"> ' + x.dateRdv.substring(0,16) + '</td></tr>'
        });
        gid("tbAffichage").innerHTML += '<tr><td></td></tr><tr><td><input type="radio" name="cours" value="math"> Math</td></tr><tr><td><input type="radio" name="cours" value="sciences"> Sciences</td><tr>';
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/api/dispo/get', this.state)
            .then(response => {
                this.affichage(response.data)
            })
    }

    
    render() {
        return (
            <div>
                <div>
                    <button onClick={this.submitHandler}>Afficher des disponibilites</button>
                </div>
                <div>
                    <table id="tableSelectDate">
                        <thead>
                            <tr id='titre'>
                            </tr>
                        </thead>
                        <tbody id='tbAffichage'>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td id="messageErreur">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        )
    }
}
export default GetDispoEleve;

function gid(id) {
    return document.getElementById(id);
}