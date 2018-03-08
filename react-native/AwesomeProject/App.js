import React, { Component } from 'react'
import { Text, View, Image } from 'react-native'

export default class App extends Component {
    render() {
        let pic = {
            uri: 'https://upload.wikimedia.org/wikipedia/commons/d/de/Bananavarieties.jpg'
        };
        return (
            <View style={{alignItems: 'center'}}>
                <Text> textInComponent </Text>
                <Image source={pic} style={{width: 193, height: 110}} />
                <View style={{alignItems: 'center'}}>
                    <Greeting name='Kobe' />
                    <Greeting name='Curry' />
                    <Greeting name='Durant' />
                </View>
            </View>
        )
    }
}

class Greeting extends Component {
    render() {
        return (
            <Text>Hello {this.props.name}!</Text>
        );
    }
}
