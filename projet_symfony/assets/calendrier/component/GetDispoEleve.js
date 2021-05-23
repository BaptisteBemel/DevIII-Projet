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

    /*submitDate() {
        let messageErreur = gid("messageErreur");
        let checkboxes = document.querySelectorAll('input[name=date]:checked');
        let radios = document.querySelectorAll('input[name=cours]:checked');
        
        let coursCheck = false;
        let coursSelect;
        let dateCheck = false;
        let dateSelect;

        for(let rad of radios) {
            if(rad.checked) {
                coursCheck = true;
                coursSelect = rad.value;
                break;
            }
        }

        for(let box of checkboxes) {
            if(box.checked) {
                dateCheck = true;
                dateSelect = box.value;
                break;
            }
        }
        
        if(!dateSelect) {
            messageErreur.innerText = "Il n'y a pas de date sélectionné !";
        }
        else if(!coursCheck) {
            messageErreur.innerText = "Il n'y a pas de cours sélectionné !";
        }
        else {
            console.log(dateSelect, coursSelect);
            messageErreur.innerText = '';
            //this.changeHandler(dateSelect, "occupé", coursSelect);
            /*this.setState({
                [dateRdv]: dateSelect,
                [statut]: "occupé",
                [matiere]: coursSelect
            });//
            //this.submitHandler(dateSelect, "occupé", coursSelect);
            let datas = {
                dateRdv: dateSelect,
                statut: "occupé",
                matiere: coursSelect
            }
            console.log(this);
            //this.putDispo(datas);
        }
    }*/

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
                    <div id="validation">
                    </div>
                </div>
            </div>
        )
    }
}
export default GetDispoEleve;

function gid(id) {
    return document.getElementById(id);
}