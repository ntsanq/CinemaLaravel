import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource, Layout} from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import {FilmCreate, FilmEdit, FilmIcon, FilmList} from "./Films";
import {FilmCategoryCreate, FilmCategoryEdit, FilmCategoryIcon, FilmCategoryList} from "./FilmCategories";
import {RoomCreate, RoomEdit, RoomIcon, RoomList} from "./Rooms";
import {FilmRuleCreate, FilmRuleEdit, FilmRuleIcon, FilmRuleList} from "./FilmRules";
import {ProductionCreate, ProductionEdit, ProductionIcon, ProductionList} from "./Productions";
import {LanguageCreate, LanguageEdit, LanguageIcon, LanguageList} from "./Languages";
import {ScheduleCreate, ScheduleEdit, ScheduleIcon, ScheduleList} from "./Schedules";
import {TicketIcon, TicketList} from "./Tickets";

import AdminBar from './AdminBar';
import {ClerkCreate, ClerkEdit, ClerkIcon, ClerkList} from "./Clerks";

export const MyLayout = props => <Layout {...props} appBar={AdminBar}/>;

export default function Home(props) {
    return (
        <>
            <Admin layout={MyLayout} dataProvider={jsonServerProvider('http://localhost:8000/api/admin')}>
                {
                    props.role === "admin" ? <>    <Resource options={{label: 'Films'}}
                                                             name="films"
                                                             list={FilmList}
                                                             edit={FilmEdit}
                                                             create={FilmCreate}
                                                             icon={FilmIcon}/>

                        <Resource options={{label: 'Film Categories'}}
                                  name="filmCategories"
                                  list={FilmCategoryList}
                                  edit={FilmCategoryEdit}
                                  create={FilmCategoryCreate}
                                  icon={FilmCategoryIcon}/>

                        <Resource name="rooms"
                                  list={RoomList}
                                  edit={RoomEdit}
                                  create={RoomCreate}
                                  icon={RoomIcon}/>

                        <Resource options={{label: 'Film Rules'}}
                                  name="filmRules"
                                  list={FilmRuleList}
                                  edit={FilmRuleEdit}
                                  create={FilmRuleCreate}
                                  icon={FilmRuleIcon}/>

                        <Resource name="productions"
                                  list={ProductionList}
                                  edit={ProductionEdit}
                                  create={ProductionCreate}
                                  icon={ProductionIcon}/>

                        <Resource name="languages"
                                  list={LanguageList}
                                  edit={LanguageEdit}
                                  create={LanguageCreate}
                                  icon={LanguageIcon}/>

                        <Resource name="clerks"
                                  list={ClerkList}
                                  edit={ClerkEdit}
                                  create={ClerkCreate}
                                  icon={ClerkIcon}/>
                    </> : null
                }

                <Resource name="schedules"
                          list={ScheduleList}
                          edit={ScheduleEdit}
                          create={ScheduleCreate}
                          icon={ScheduleIcon}/>

                <Resource name="tickets"
                          options={{label: 'Tickets'}}
                          list={TicketList}
                          icon={TicketIcon}/>
            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    let role = document.getElementById('admin_dashboard').getAttribute('role');
    createRoot(document.getElementById('admin_dashboard')).render(<Home role={role}/>);
}
