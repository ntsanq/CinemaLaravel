import * as React from "react";
import {
    List,
    Datagrid,
    Edit,
    Create,
    SimpleForm,
    TextField,
    EditButton,
    TextInput,
    useRecordContext,
    ImageField,
    SingleFieldList,
    ChipField,
    ReferenceArrayField,
    ReferenceArrayInput,
    SelectArrayInput,
    RichTextField,
    ReferenceField,
    ReferenceInput,
    SelectInput,
    UrlField,
    Pagination
} from 'react-admin';

import {useMediaQuery} from "@mui/material";
import {RichTextInput} from "ra-input-rich-text";
import LocalMoviesIcon from '@mui/icons-material/LocalMovies';

export const FilmIcon = LocalMoviesIcon;
const FilmPagination = () => <Pagination rowsPerPageOptions={[5, 10, 25, 50]}/>;

const filmFilters = [
    <TextInput source="name" label="Search" alwaysOn name="search"/>,
    <ReferenceInput source="production_id" label="Productions" reference="productions" name="production_id">
        <SelectInput optionText="name"/>
    </ReferenceInput>,
    <ReferenceInput source="language_id" label="Languages" reference="languages" name="language_id">
        <SelectInput optionText="name"/>
    </ReferenceInput>,
    <ReferenceArrayInput source="film_category_id" reference="filmCategories" name="film_category_id">
        <SelectInput optionText="name"/>
    </ReferenceArrayInput>,
    <ReferenceArrayInput source="film_rule_id" reference="filmRules" name="film_rule_id">
        <SelectInput optionText="name"/>
    </ReferenceArrayInput>
];


export const FilmList = () => {
    const isSmall = useMediaQuery((theme) => theme.breakpoints.down("sm"));
    return (
        <List filters={filmFilters} pagination={<FilmPagination/>}>
            <Datagrid rowClick="edit">
                <TextField source="id"/>
                <ReferenceArrayField source="film_category_id" reference="filmCategories">
                    <SingleFieldList>
                        <ChipField source="name"/>
                    </SingleFieldList>
                </ReferenceArrayField>
                <ReferenceArrayField source="film_rule_id" reference="filmRules">
                    <SingleFieldList>
                        <ChipField source="name"/>
                    </SingleFieldList>
                </ReferenceArrayField>
                <TextField source="name"/>
                <ImageField source="path" label="Image"/>
                <UrlField source="trailer"/>
                <ReferenceField source="production_id" reference="productions">
                    <ChipField source="name"/>
                </ReferenceField>
                <ReferenceField source="language_id" reference="languages">
                    <ChipField source="name"/>
                </ReferenceField>
                <EditButton/>
            </Datagrid>
        </List>
    )

};

const FilmTitle = () => {
    const record = useRecordContext();
    return <span>Film{record ? `: ${record.name}` : ''}</span>;
};

export const FilmEdit = () => (
    <Edit title={<FilmTitle/>}>
        <SimpleForm>
            <TextInput disabled source="id" name="id"/>
            <TextInput source="name" name="name"/>
            <ReferenceArrayInput source="film_category_id" reference="filmCategories" name="film_category_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceArrayInput source="film_rule_id" reference="filmRules" name="film_rule_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceInput source="production_id" reference="productions" name="production_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <ReferenceInput source="language_id" reference="languages" name="language_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <TextInput label="Image" source="path" name="path" sx={{minWidth: "450px"}}/>
            <TextInput source="trailer" name="trailer" sx={{minWidth: "450px"}}/>
            <RichTextInput source="description" name="description"/>
        </SimpleForm>
    </Edit>
);

export const FilmCreate = () => (
    <Create title="Create a Film">
        <SimpleForm>
            <TextInput source="name" name="name"/>
            <ReferenceArrayInput source="film_category_id" reference="filmCategories" name="film_category_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceArrayInput source="film_rule_id" reference="filmRules" name="film_rule_id">
                <SelectArrayInput/>
            </ReferenceArrayInput>
            <ReferenceInput source="production_id" reference="productions" name="production_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <ReferenceInput source="language_id" reference="languages" name="language_id">
                <SelectInput optionText="name"/>
            </ReferenceInput>
            <TextInput label="Image" source="path" name="path" sx={{minWidth: "450px"}}/>
            <TextInput source="trailer" name="trailer" sx={{minWidth: "450px"}}/>
            <RichTextInput source="description" name="description"/>
        </SimpleForm>
    </Create>
);
