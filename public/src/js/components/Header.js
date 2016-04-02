import React from 'react';
import { Link } from 'react-router';
import { Navbar, Nav, NavItem, NavDropdown, MenuItem } from 'react-bootstrap';

export default class Header extends React.Component {
	render() {
		return (
			<Navbar fixedTop className="ilearn-main-nav">
				<Navbar.Header>
					<Navbar.Brand>
						<Link to="/home">WH-LMS</Link>
					</Navbar.Brand>
				</Navbar.Header>
				<Nav pullRight>
					<li>
						<Link to="/notifications"><i className="fa fa-bell"></i></Link>
					</li>
					<li>
						<Link to="/profile">Reynold</Link>
					</li>
					<NavItem eventKey={4} href="/logout"><i className="fa fa-sign-out"></i></NavItem>
				</Nav>
			</Navbar>
		);
	}
}