import React, { Component } from 'react';
import { Text, TextInput, View, Image, ScrollView } from 'react-native';
class PizzaTranslator extends Component {
  constructor(props) {
    super(props);
    this.state = {text: ''};
  }

  render() {
    return (
      <View style={{padding: 10}}>
        <TextInput
          style={{height: 40}}
          placeholder="Type here to translate!"
          onChangeText={(text) => this.setState({text})}
        />
        <Text style={{padding: 10, fontSize: 42}}>
          {this.state.text.split(' ').map((word) => word && '🍕').join(' ')}
        </Text>

        <ScrollView>
          <Text style={{fontSize:96}}>Scroll me plz</Text>
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />

          <Text style={{fontSize:96}}>Hello World</Text>
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          
          <Text style={{fontSize:96}}>React</Text>
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          
          <Text style={{fontSize:96}}>React-Native</Text>
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          
          <Text style={{fontSize:96}}>Javascript</Text>
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
          <Image source={require('./favicon.png')} style={{height: 100, width: 100}} />
        </ScrollView>
      </View>
    );
  }
}

export default PizzaTranslator;
