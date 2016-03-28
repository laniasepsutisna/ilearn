import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, IndexRoute, hashHistory } from 'react-router';

import { Nav, Button, Container, Row } from 'react-bootstrap';

import Layout from './app/layout/Layout';
import Home from './app/pages/Home';

const app = document.getElementById('app');

ReactDOM.render(
	<Router history={hashHistory}>
		<Route path="/" component={Layout}>
			<IndexRoute component={Home}></IndexRoute>
		</Route>
	</Router>, 
app);