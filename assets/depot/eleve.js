import React, { Component } from 'react'
import axios from 'axios'
import { render } from 'react-dom'
import * as ReactBootStrap from "react-bootstrap"
import { Link } from 'react-router-dom'

class DepotEleve extends Component {
    constructor(props) {
        super(props)

        this.state = {
            title: "",
            description: "",
            fileName: ""
        }
    }

    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('https://siteinternetcoursparticulier.herokuapp.com/ressources', this.state)
            .then(response => {
                this.renderFiles(response.data)
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderFiles(données) {
        console.log(données)
        if(données.length == 0){
            document.getElementById('divRoot').innerHTML = '<p variation="success" style="margin: 3%; font-size: 150%;">Il n\'y a pas de ressources disponibles.</p>'
        }
        else{
            document.getElementById('divRoot').innerHTML = données.map(champ => {
                return (
                    '<div style="margin: 1%; margin-left: 2%; padding-right: 2%; width: min-content; border: solid; border-width:2px; border-color: AliceBlue;"><a href='+ champ.fileName + ' target="_blank" download><h3 style="margin: 3%;">' + champ.titre + '</h3></a><p style="margin: 3%; font-size: 150%;">' + champ.description + '</p></div>'
                )
            }).join('')
        }
    }

    render() {
        return (
            <div>
                <h2 style={{fontFamily: 'rockwell', fontSize: '200%', marginBottom: '1%'}}>Ressources disponibles: </h2>
                <div id='divRoot'>
                </div>
            </div>
        )
    } 
}

export default DepotEleve;