import { Link } from "@inertiajs/inertia-react";
import { useState } from "react";

const Clientlist = ({ client }) => {
    const [editting, setEditing] = useState(false);

    return (
        <tr>
            <td>{client.user_id}</td>
            <td>{client.name}</td>
            <td>{client.initiate_login_uri}</td>
            <td>{client.redirect_uris}</td>

            <td>
                <Link
                    href={route("oidc.edit", client.user_id)}
                    className="inline-block text-sm font-semibold py-2.5 px-4 bg-sky-900 text-white hover:bg-sky-700 mr-1"
                    onClick={() => setEditing(true)}
                >
                    Edit
                </Link>

                <button className="inline-block text-sm font-semibold py-2.5 px-4 bg-indigo-900 text-white hover:bg-indigo-700 mr-1">
                    Approve
                </button>

                <Link
                    className="inline-block text-sm font-semibold py-2.5 px-4 bg-red-700 text-white hover:bg-red-500"
                    href={route("oidc.destroy", client.user_id)}
                    method="delete"
                >
                    Delete
                </Link>
            </td>
        </tr>
    );
};

export default Clientlist;
