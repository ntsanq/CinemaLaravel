import React, {useState} from 'react';
import {createRoot} from "react-dom/client";

export default function ProfileButton(props) {
    const user = JSON.parse(props.user);

    return (
        <div className="uk-button-group">
            <div
                className="uk-button-large"
                data-uk-dropdown>
                {user.name}{" "}
                <i className="uk-icon-chevron-down"></i>
                <div className="uk-dropdown logout-btn uk-text-center">
                    <div >
                        <a href="/profile" >
                            <button id="profile-button" type="submit"
                                    className="uk-button-link">
                                Profile <i className="uk-icon-user"></i>
                            </button>
                        </a>
                    </div>
                    <div >
                        <a href="/myTickets" >
                            <button id="profile-button" type="submit"
                                    className="uk-button-link">
                                My tickets <i className="uk-icon-ticket"></i>
                            </button>
                        </a>
                    </div>
                    <div >
                        <form action="/signOut" method="post">
                            <button id="sign-out-button" type="submit"
                                    className="uk-button-link">
                                Logout <i className="uk-icon-sign-out"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}

if (document.getElementById('profile_button')) {
    let user = document.getElementById('profile_button').getAttribute('user');
    createRoot(document.getElementById('profile_button')).render(<ProfileButton user={user}/>);
}

