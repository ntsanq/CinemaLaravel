import React, {useEffect, useState} from 'react';
import Loading from "./Loading";

export default function TimePick(props) {
    const [selectedTime, setSelectedTime] = useState("null");
    const [loading, setLoading] = useState(false);
    const [activeIndex, setActiveIndex] = useState(null);

    useEffect(() => {
        setLoading(true)
        setTimeout(() => {
            setLoading(false)
        }, 500)
    }, [props.timesData[0]])

    useEffect(() => {
        props.onData(selectedTime);
    }, [selectedTime])

    const listItems = props.timesData.map((time, index) => (
        <button
            key={index}
            onClick={(e) => handleButton(e, index)}
            className={`time-button uk-margin-top ${activeIndex === index ? 'active' : ''}`}
            style={{marginLeft: '20px'}}
        >
            {time.start} <span hidden>{time.room_id}</span>
        </button>
    ));


    function handleButton(e, index) {
        setSelectedTime(e.target.textContent);
        const buttonContent = e.target.textContent.split(' ');
        const roomId = buttonContent[1];
        props.getSeats(roomId);
        setActiveIndex(index);
    }

    return (
        <div className="time-pick uk-margin-large-bottom">
            <h2 className="uk-text-contrast">Choose time:</h2>
            {
                loading ? <Loading/> :
                    <>
                        {
                            listItems[0] ?
                                <div className="grid-button">
                                    <div>{listItems}</div>
                                </div> :
                                <div>Pick another date</div>
                        }
                    </>
            }
        </div>
    );
}
