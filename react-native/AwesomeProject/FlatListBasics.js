import React, { Component } from 'react';
import { FlatList, StyleSheet, Text, View, SectionList } from 'react-native';

class FlatListBasics extends Component {
  // getMoviesFromApiAsync() {
  //   return fetch('https://facebook.github.io/react-native/movies.json')
  //     .then((response) => {
  //       console.log(response.json());
  //       response.json()
  //     })
  //     .then((responseJson) => {
  //       console.log(responseJson.movies);
  //       return responseJson.movies;
  //     })
  //     .catch((error) => {
  //       console.log(error);
  //     });
  // }

  getMoviesFromApiAsync() {
    return fetch('https://facebook.github.io/react-native/movies.json')
      .then((response) => response.json())
      .then((responseJson) => {
        return responseJson.movies;
      })
      .catch((error) => {
        console.error(error);
      });
  }
  
  render() {
    const data = [
      {key: 'Devin'},
      {key: 'Jackson'},
      {key: 'James'},
      {key: 'Joel'},
      {key: 'John'},
      {key: 'Jillian'},
      {key: 'Jimmy'},
      {key: 'Julie'},
    ];
    this.getMoviesFromApiAsync();
    return (
      <View style={styles.container}>
        {/* <FlatList
          data={data}
          renderItem={({item}) => <Text style={styles.item}>{item.key}</Text>}
        /> */}
        
        <SectionList
          sections={[
            {title: 'D', data: ['Devin']},
            {title: 'J', data: ['Jackson', 'James', 'Jillian', 'Jimmy', 'Joel', 'John', 'Julie']}
          ]}
          renderItem={({item}) => <Text style={styles.item}>{item}</Text>}
          renderSectionHeader={({section}) => <Text style={styles.sectionHeader}>{section.title}</Text>}
        />
      </View>
    );
  }
}

export default FlatListBasics;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    paddingTop: 22
  },
  item: {
    padding: 10,
    fontSize: 18,
    height: 44,
  },
  sectionHeader: {
    paddingTop: 2,
    paddingLeft: 10,
    paddingRight: 10,
    paddingBottom: 2,
    fontSize: 14,
    fontWeight: 'bold',
    backgroundColor: 'rgba(247,247,247,1.0)',
  },
});
